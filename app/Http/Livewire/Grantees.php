<?php


    namespace App\Http\Livewire;

    use App\Models\Campus;
    use App\Models\Course;
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
        public $selectedfund2sources2;
        public $studentId, $student;

            protected $rules = [
                'student_id' => 'required',
                'semester' => 'required',
                'selectedYear' => 'required',
            ];

        public function fetchSchoolYears()
        {
            $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
        }

        public function saveStudent()
      {

            $this->validate();

            $studentData = [
                'student_id' => $this->student_id,
                'semester' => $this->semester,
                'school_year' => $this->selectedYear,
                'scholarship_type' => $this->selectedScholarshipType1,
                'scholarship_name' => $this->fundSources1,
            ];

            $student = Student::create($studentData);



        session()->flash('success', 'Student data saved successfully!');
            // Reset the form fields
            $this->resetForm();

        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added ' .$this->firstname .$this->lastname. ' as a new scholars',
            'data' => json_encode('Added by '. $user->name),
        ]);
        }

        public function mount($studentId)
        {
            $this->student = $studentId;
            // Load the student details based on $studentId
            $this->student = Student::findOrFail($studentId);
           // $campus= Campus::findOrfail('selectedCampus');

            $this->student_id= $this->student->student_id;
            $this->lastname= $this->student->lastname;
            $this->firstname= $this->student->firstname;
            $this->initial= $this->student->initial;
            $this->email= $this->student->email;
            $this->sex= $this->student->sex;
            $this->status= $this->student->status;
            $this->selectedBarangay= $this->student->barangay;
            $this->selectedMunicipality = $this->student->municipal;
            $this->selectedProvince= $this->student->province;
            $this->selectedCampus= $this->student->campus;
            $this->selectedCourse= $this->student->course;
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

            // $student = Student::findOrFail($this->student);
            // Load fund sources based on the selected scholarship type for Scholarship 1
            $fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)->get();

        // Load fund  based on the selected scholarship type for Scholarship 2
            $fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)->get();


            $courses = Course::all();

            return view('livewire.grantees', [
                'years' => $this->years,
                'fundSources1' => $fundSources1,
                'fundSources2' => $fundSources2,
                'courses' => $courses,
                'student' => $this->student
                // 'student' => $this->student,



            ])->extends('layouts.includes.admin.index')->section('content');
        }

        public function updatedSelectedScholarshipType1()
        {
            // Reset fund sources when the scholarship type for Scholarship 1 changes
            $this->selectedfundsources1 = null;
        }

        public function updatedSelectedScholarshipType2()
        {
            // Reset fund sources when the scholarship type for Scholarship 2 changes
            $this->selectedfund2sources2 = null;
        }

    }
