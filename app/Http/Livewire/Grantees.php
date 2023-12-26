<?php


namespace App\Http\Livewire;

use App\Models\Grantee;
use App\Models\StudentGrantee;
    use App\Models\Campus;
    use App\Models\Course;
    use App\Models\Province;
    use App\Models\Municipal;
    use App\Models\Barangay;
    use App\Traits\Variables;
    use Illuminate\Support\Facades\Log;
    use App\Models\AuditLog;
    use App\Models\Student;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use App\Models\ScholarshipName;
    use App\Models\SchoolYear;


    class Grantees extends Component
    {
        use Variables;

    public $selectedScholarshipType1;
    public $selectedfundsources1;
    public $selectedScholarshipType2;
    public $selectedfundsources2;

    public $studentId, $student, $school_year;

    protected $rules = [
        'student_id' => 'required',
        'semester' => 'required',
        'school_year' => 'required',
        'selectedScholarshipType1' => 'required_without:selectedScholarshipType2',
        'selectedfundsources1' => 'required_with:selectedScholarshipType1',
        'selectedScholarshipType2' => 'required_without:selectedScholarshipType1',
        'selectedfundsources2' => 'required_with:selectedScholarshipType2',
    ];


        public function fetchSchoolYears()
        {
            $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
        }


        public function mount($studentId)
        {
            $this->student = $studentId;
            // Load the student details based on $studentId
            $this->student = Student::findOrFail($studentId);


            $this->student_id = $this->student->student_id;
            $this->lastname= $this->student->lastname;
            $this->firstname= $this->student->firstname;
            $this->initial= $this->student->initial;
            $this->email= $this->student->email;
            $this->sex= $this->student->sex;
            $this->status= $this->student->status;
            // Use join to get the related models
            $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
                ->where('students.id', $this->student->id)
                ->value('brgyDesc') ?? "No data";

            $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
                ->where('students.id', $this->student->id)
                ->value('citymunDesc') ?? "No data";

            $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
                ->where('students.id', $this->student->id)
                ->value('provDesc') ?? "No data";
            $this->selectedCampus = Campus::find($this->student->campus);
            $this->selectedCourse = Course::find($this->student->course);
            $this->level= $this->student->level;
            $this->father= $this->student->father;
            $this->mother= $this->student->mother;
            $this->contact= $this->student->contact;
            $this->studentType= $this->student->studentType;
            $this->nameSchool = $this->student->nameSchool ?? "No data";
            $this->lastYear= $this->student->lastYear ?? "No data";


            if ($this->student->grantees->isNotEmpty()) {

            $this->school_year = $this->student->grantees->first()->school_year;
            $this->semester = $this->student->grantees->first()->semester;
            } else {
                $this->school_year = null; // or provide a default value
                $this->semester =  null;

            }



            if ($this->student->studentGrantee->isNotEmpty()) {

                $this->selectedScholarshipType1 = $this->student->studentGrantee->first()->scholarship_type;
                $this->selectedfundsources1 = $this->student->studentGrantee->first()->scholarship_name;


            } else {


                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }

            if ($this->student->studentGrantee->count() > 1) {
                $secondStudentGrantee = $this->student->studentGrantee->get(1);

                $this->selectedScholarshipType2 = $secondStudentGrantee->scholarship_type;
                $this->selectedfundsources2 = $secondStudentGrantee->scholarship_name;
            } else {
                // Set default values when there is no second student grantee
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }

        }


        public function render()
        {
            // Call the methods to fetch scholarship data
            $this->fetchSchoolYears();

            $fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)->get();

            $fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)->get();

            if(auth()->user()->role === 0)
            {
             return view('livewire.grantees', [
                'years' => $this->years,
                'fundSources1' => $fundSources1,
                'fundSources2' => $fundSources2,
                'student' => $this->student
            ])->extends('layouts.includes.admin.index')
              ->section('content');
            } elseif(auth()->user()->role === 1)
            {
                return view('livewire.grantees', [
                    'years' => $this->years,
                    'fundSources1' => $fundSources1,
                    'fundSources2' => $fundSources2,
                    'student' => $this->student
                ])->extends('layouts.includes.admin.index')
                  ->section('content');

            } else{
             return view('livewire.grantees', [
                'years' => $this->years,
                'fundSources1' => $fundSources1,
                'fundSources2' => $fundSources2,
                'student' => $this->student
            ])->extends('layouts.includes.admin.index')
              ->section('content');

            }
        }


        public function updatedSelectedScholarshipType1()
        {
            // Reset fund sources when the scholarship type for Scholarship 1 changes
            $this->selectedfundsources1 = null;
        }

        public function updatedSelectedScholarshipType2()
        {
            // Reset fund sources when the scholarship type for Scholarship 2 changes
            $this->selectedfundsources2 = null;
        }



        public function addScholarship()
{
    $this->validate();

    // Determine if an existing Grantee record exists for the student
    $granteeExists = Grantee::where('student_id', $this->student->id)->exists();
    // Log::info($granteeExists);

    // Create the Grantee record only if there isn't one already
    if (!$granteeExists) {
        Grantee::create([
            'student_id' => $this->student->id,
            'school_year' => $this->school_year,
            'semester' => $this->semester,
        ]);
    }

    // Gather the valid scholarship details for creation
    $scholarshipsToCreate = collect([
        ['type' => $this->selectedScholarshipType1, 'name' => $this->selectedfundsources1],
        ['type' => $this->selectedScholarshipType2, 'name' => $this->selectedfundsources2],
    ])->filter(function ($scholarship) {
        return $scholarship['type'] !== null && $scholarship['name'] !== null;
    });

    // Create StudentGrantee records for each valid scholarship, excluding the first one if it already exists
    $scholarshipsCreatedCount = 0;
    $scholarshipsToCreate->each(function ($scholarship, $index) use (&$scholarshipsCreatedCount, $granteeExists) {
        if (!$granteeExists || $index > 0) { // Skip only when a grantee exists or for subsequent scholarships
            StudentGrantee::create([
                'student_id' => $this->student->id,
                'scholarship_type' => $scholarship['type'],
                'scholarship_name' => $scholarship['name'],
            ]);
            $scholarshipsCreatedCount++;
        }
    });

    // Display appropriate success message
    $message = $scholarshipsCreatedCount > 1
        ? 'New grantees have been added successfully!'
        : ($scholarshipsCreatedCount > 0 ? 'New grantee has been added successfully!' : 'No changes made.');
    session()->flash('success', $message);

    // Log the action
    $user = Auth::user();
    AuditLog::create([
        'user_id' => $user->id,
        'action' => 'Added ' . $this->firstname . ' ' . $this->lastname . ' as a new scholar',
        'data' => json_encode(['scholarship_count' => $scholarshipsCreatedCount]),
    ]);
}


        }
