<?php


    namespace App\Http\Livewire;
    use App\Traits\Variables;
    use App\Models\AuditLog;
    use App\Models\Campus;
    use App\Models\Student;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use App\Models\Barangay;
    use App\Models\Province;
    use App\Models\Municipal;
    use App\Models\ScholarshipName;
    use App\Models\SchoolYear;


    class Grantees extends Component
    {
        use Variables;

        public $selectedScholarshipType1;
        public $selectedfundsources1;
        public $selectedScholarshipType2;
        public $selectedfund2sources2;

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


        public function render()
        {

            // Call the methods to fetch scholarship data
            $this->fetchSchoolYears();

            if (auth()->user()->role === 0 || auth()->user()->role === 1) {
                // User is an admin or superadmin, fetch all campuses
                $this->campuses = Campus::all();
            } else {
                // User is not an admin or superadmin, fetch campuses based on specific conditions
                $this->campuses = Campus::where('id', 1)->get();
            }

            if ($this->selectedCampus) {
                $campus = Campus::findOrFail($this->selectedCampus);
                $this->courses = $campus->courses;
            } else {
                $this->courses = [];
            }

            // Fetch provinces
            $this->provinces = Province::where('regCode', 01)->get();

            // Fetch municipalities and barangays based on the selected province and municipality
            if ($this->selectedProvince) {
                $this->municipalities = Municipal::where('provCode', $this->selectedProvince)->get();
            } else {
                $this->municipalities = [];
            }

            if ($this->selectedMunicipality) {
                $this->barangays = Barangay::where('citymunCode', $this->selectedMunicipality)->get();
            } else {
                $this->barangays = [];
            }

            // Load fund sources based on the selected scholarship type for Scholarship 1
        $fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)->get();

        // Load fund sources based on the selected scholarship type for Scholarship 2
        $fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)->get();

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
                'years' => $this->years,
                'fundSources1' => $fundSources1,
                'fundSources2' => $fundSources2,


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
            $this->selectedfund2sources2 = null;
        }

            // Method to reset the form fields
            public function resetForm()
            {
                $this->semester = "";
                $this->studentType = "";
                $this->nameSchool = "";
                $this->lastYear = "";
                $this->father = "";
                $this->mother = "";
            }

    }
