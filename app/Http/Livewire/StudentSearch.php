<?php

namespace App\Http\Livewire;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Models\StudentGrantee;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Auth;

class StudentSearch extends Component
{
    use Variables;
    public $existingStudent;
    public $noStudentRecord = false;

    public function studentSearch()
    {

        if (auth()->user()->role == 0 || auth()->user()->role == 1) {
            $this->existingStudent = Student::where('student_id', $this->student_id)->first();
        } else {
            $this->existingStudent = Student::where('student_id', $this->student_id)
                ->where('campus', 1)
                ->first();

            // Additional validation for users with roles other than 0 or 1
            if ($this->existingStudent && $this->existingStudent->campus !== 1) {
                // If the student's campus is not 1, handle the error or add your custom logic
                $error = 'Access Denied!';
                session()->flash('success', $error);
            }
        }

        if (!$this->existingStudent) {
            $this->noStudentRecord = true;
        } else {
            $this->lastname = $this->existingStudent->lastname;
            $this->firstname = $this->existingStudent->firstname;
            $this->initial = $this->existingStudent->initial;

            $this->sex = $this->existingStudent->sex;
            $this->status = $this->existingStudent->status;
            $this->email = $this->existingStudent->email;
            $this->contact = $this->existingStudent->contact;

            $this->selectedCampus = Campus::join('students', 'campuses.id', '=', 'students.campus')
                ->where('students.id', $this->existingStudent->id)
                ->value('campusDesc') ?? "No data";
            $this->selectedCourse = Course::join('students', 'courses.course_id', '=', 'students.course')
                ->where('students.id', $this->existingStudent->id)
                ->value('course_name') ?? "No data";

            $this->studentType = $this->existingStudent->studentType;
            $this->nameSchool = $this->existingStudent->nameSchool ?? "No Data";
            $this->lastYear = $this->existingStudent->lastYear ?? "No Data";

            $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
                ->where('students.id', $this->existingStudent->id)
                ->value('brgyDesc') ?? "No data";

            $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
                ->where('students.id', $this->existingStudent->id)
                ->value('citymunDesc') ?? "No data";

            $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
                ->where('students.id', $this->existingStudent->id)
                ->value('provDesc') ?? "No data";

            $this->level = $this->existingStudent->level;

            $this->father = $this->existingStudent->father;
            $this->mother = $this->existingStudent->mother;

            if ($this->existingStudent->grantees) {
                if ($this->existingStudent->grantees->isNotEmpty()) {
                    $this->school_year = $this->existingStudent->grantees->first()->school_year;
                    $this->semester = $this->existingStudent->grantees->first()->semester;
                } else {
                    $this->school_year = null;
                    $this->semester = null;
                }
            } else {
                $this->school_year = null;
                $this->semester = null;
            }

            if ($this->existingStudent->studentGrantee) {
                if ($this->existingStudent->studentGrantee->isNotEmpty()) {
                    $this->selectedScholarshipType1 = $this->existingStudent->studentGrantee->first()->scholarship_type;
                    $this->selectedfundsources1 = $this->existingStudent->studentGrantee->first()->scholarship_name;
                } else {
                    $this->selectedScholarshipType1 = null;
                    $this->selectedfundsources1 = null;
                }
            } else {
                $this->selectedScholarshipType1 = null;
                $this->selectedfundsources1 = null;
            }

            if ($this->existingStudent->studentGrantee && $this->existingStudent->studentGrantee->count() > 1) {
                $secondStudentGrantee = $this->existingStudent->studentGrantee->get(1);

                $this->selectedScholarshipType2 = $secondStudentGrantee->scholarship_type;
                $this->selectedfundsources2 = $secondStudentGrantee->scholarship_name;
            } else {
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }
        }
    }



    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
    }

    public function render()
    {
        $this->fetchSchoolYears();

        $fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)->get();

        $fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)->get();


        return view('livewire.student-search',[
            'years' => $this->years,
            'fundSources1' => $fundSources1,
            'fundSources2' => $fundSources2,
            'existingStudent' => $this->existingStudent,
            'noStudentRecord' => $this->noStudentRecord,
        ]);
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
    public function addSeach()
    {
        $this->validate();

        // Determine if an existing Grantee record exists for the student
        $granteeExists = Grantee::where('student_id', $this->existingStudent->id)->exists();

        // Create the Grantee record only if there isn't one already
        if (!$granteeExists) {
            Grantee::create([
                'student_id' => $this->existingStudent->id,
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
                    'student_id' => $this->existingStudent->id,
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

    public function redirectToAddStudent()
    {
        return redirect()->route('admin.actions.add_student');
    }


}
