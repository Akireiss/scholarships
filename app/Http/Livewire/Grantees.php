<?php


namespace App\Http\Livewire;

use App\Models\Grantee;
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

    public $save_selectedScholarshipType1;
    public $save_selectedfundsources1;
    public $save_selectedScholarshipType2;
    public $save_selectedfundsources2;

    public $studentId, $student, $save_school_year, $save_semester, $school_year;
    public $fundSourceName;

            protected $rules = [
                'student_id' => 'required',
                // 'semester' => 'required',
                // 'selectedYear' => 'required',
            ];

        public function fetchSchoolYears()
        {
            $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
        }

    //     public function saveStudent()
    //   {

    //         $this->validate();

    //         $studentData = [
    //             'student_id' => $this->student_id,
    //             'semester' => $this->semester,
    //             'school_year' => $this->selectedYear,
    //             'scholarship_type' => $this->selectedScholarshipType1,
    //             'scholarship_name' => $this->fundSources1,
    //         ];

    //         $student = Student::create($studentData);



    //     session()->flash('success', 'Student data saved successfully!');
    //         // Reset the form fields
    //         $this->resetForm();

    //     $user = Auth::user();
    //     AuditLog::create([
    //         'user_id' => $user->id,
    //         'action' => 'Added ' .$this->firstname .$this->lastname. ' as a new scholars',
    //         'data' => json_encode('Added by '. $user->name),
    //     ]);
    //     }

        public function mount($studentId)
        {
            $this->student = $studentId;
            // Load the student details based on $studentId
            $this->student = Student::findOrFail($studentId);
            

            $this->student_id= $this->student->student_id;
            $this->lastname= $this->student->lastname;
            $this->firstname= $this->student->firstname;
            $this->initial= $this->student->initial;
            $this->email= $this->student->email;
            $this->sex= $this->student->sex;
            $this->status= $this->student->status;
            // Use the find method to get the related models
            $this->selectedBarangay = Barangay::find($this->student->barangay);
            $this->selectedMunicipality = Municipal::find($this->student->municipal);
            $this->selectedProvince = Province::find($this->student->province);
            $this->selectedCampus = Campus::find($this->student->campus);
            $this->selectedCourse = Course::find($this->student->course);
            $this->level= $this->student->level;
            $this->father= $this->student->father;
            $this->mother= $this->student->mother;
            $this->contact= $this->student->contact;
            $this->studentType= $this->student->studentType;
            $this->nameSchool = $this->student->nameSchool ?? "No data";
            $this->lastYear= $this->student->lastYear ?? "No data";

        }

        public function render()
        {
            // Call the methods to fetch scholarship data
            $this->fetchSchoolYears();

            // Load fund sources based on the selected scholarship type for Scholarship 1
            $fundSources1 = ScholarshipName::where('scholarship_type', $this->save_selectedScholarshipType1)->get();

            // Load fund based on the selected scholarship type for Scholarship 2
            $fundSources2 = ScholarshipName::where('scholarship_type', $this->save_selectedScholarshipType2)->get();

            // $fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)->get();
            // // Load fund based on the selected scholarship type for Scholarship 2
            // $fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)->get();

            return view('livewire.grantees', [
                'years' => $this->years,
                'fundSources1' => $fundSources1,
                'fundSources2' => $fundSources2,
                'student' => $this->student
            ])->extends('layouts.includes.admin.index')
              ->section('content');
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
        



        // add

        public function addGrantee()
        {
            // Validation
            // $this->validate([
            //     'save_semester' => 'required',
            //     'save_school_year' => 'required',
            //     'save_selectedScholarshipType1' => 'required',
            //     'save_selectedfundsources1' => 'required',
            //     'save_selectedScholarshipType2' => 'required',
            //     'save_selectedfundsources2' => 'required',
            // ]);

            $student = Student::findOrFail($this->studentId);

            if ($student) {
                $newGrantee = $student->grantees()->create([
                    'semester' => $this->save_semester,
                    'school_year' => $this->save_school_year,
                ]);

                $newGrantee->studentGrantee()->create([
                    'scholarship_type' => $this->save_selectedScholarshipType1,
                    'scholarship_name' => $this->save_selectedfundsources1,
                ]);

                $newGrantee->studentGrantee()->create([
                    'scholarship_type' => $this->save_selectedScholarshipType2,
                    'scholarship_name' => $this->save_selectedfundsources2,
                ]);

                session()->flash('success', 'New grantees added successfully!');
            } else {
                session()->flash('error', 'Student not found.');
            }
        }

        public function updateGrantee()
        {
            // Validation
            // $this->validate([
            //     'selectedScholarshipType1' => 'required',
            //     'selectedfundsources1' => 'required',
            // ]);

            $grantee = Grantee::findOrFail($this->studentId);

            if ($grantee) {
                $grantee->update([
                    'semester' => $this->semester,
                    'school_year' => $this->{"school_year_{$grantee->id}"},
                ]);

                foreach ($grantee->studentGrantee as $studentGrant) {
                    $studentGrant->update([
                        'scholarship_type' => $this->selectedScholarshipType1,
                        'scholarship_name' => $this->selectedfundsources1,
                    ]);
                }

                session()->flash('success', 'New grantees added successfully!');
            } else {
                session()->flash('error', 'Grantee not found.');
            }
        }

    public function updatedSelectedfundsources1($value)
    {
        // Fetch the fund source name based on the selected ID
        $fundSource = ScholarshipName::find($value);

        // Update the public property with the fund source name
        $this->fundSourceName = $fundSource ? $fundSource->name : null;
    }




}
