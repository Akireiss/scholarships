<?php


    namespace App\Http\Livewire;
    use App\Traits\Variables;
    use App\Models\AuditLog;
    use App\Models\Fund;
    use App\Models\Campus;
    use App\Models\Course;
    use App\Models\FundSource;
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
        public $selectedScholarshipType2;
        public $fundSources1 = [];
        public $fundSources2 = [];


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

        $privateStudentData = [

        ];

        $privateStudent = Student::create($privateStudentData);



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

        public function updatedSelectedScholarshipType1()
        {
            $this->fundSources1 = $this->getFundSources($this->selectedScholarshipType1);
        }

        public function updatedSelectedScholarshipType2()
        {
            $this->fundSources2 = $this->getFundSources($this->selectedScholarshipType2);
        }

        private function getFundSources($scholarshipType)
        {
            // Fetch fund sources based on the selected scholarship type
            $scholarshipTypeAttribute = $this->mapScholarshipType($scholarshipType);

            // Replace this with your actual logic to fetch fund sources
            $fundSources = ScholarshipName::where('scholarship_type', $scholarshipTypeAttribute)
                ->pluck('name')
                ->toArray();

            return $fundSources;
        }

        private function mapScholarshipType($selectedType)
        {
            // Map Livewire selected type to actual database value
            return $selectedType === 'Government' ? 0 : ($selectedType === 'Private' ? 1 : null);
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

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
                'years' => $this->years, // Pass the years data to the view


            ]);
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
