<?php

    namespace App\Http\Livewire;

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


    class Grantees extends Component
    {
            public $selectedScholarship;
            // campus & course
            public $selectedCampus, $campuses;
            public $selectedCourse, $courses = [];

            public $governmentScholars = [],  $selectedScholarshipType, $scholarshipType;
            public $privateScholars = [];
            public $selectedGovernmentScholarship, $selectedPrivateFundSources = [];
            public $selectedPrivateScholarship, $selectedGovernmentFundSources = []; // Update the property name
            public $governmentFundSources = [], $privateFundSources = [], $selectedFunds;

            // Personal Information
            public $lastname, $firstname, $initial;
            public $sex, $status, $contact, $email, $level, $semester;
            public $nameSchool, $lastYear;
            public $student_id,  $scholarshipLimitExceeded = false;
            public $grant_status;
            public $studentType;
            public $father, $mother;

            // Address
            public $selectedProvince;
            public $selectedMunicipality;
            public $selectedBarangay;
            public $provinces = [];
            public $municipalities = [];
            public $barangays = [];

            // show&hide
            public $showNewInput = false;



            protected $rules = [
                'selectedCampus' => 'required',
                'selectedCourse' => 'required',
                'lastname' => 'required',
                'firstname' => 'required',
                'initial' => 'required',
                'sex' => 'required',
                'status' => 'required',
                'selectedProvince' => 'required',
                'selectedMunicipality' => 'required',
                'selectedBarangay' => 'required',
                'contact' => 'required|min:11|max:11',
                'email' => 'required|email',
                'student_id' => 'required',
                'level' => 'required',
                'semester' => 'required',
                'grant_status' => 'required',
                'studentType' => 'required',
                'father' => 'required',
                'mother' => 'required',
            ];

            public function updatedStudentType($value)
            {
                if ($value === 'New') {
                    $this->showNewInput = true;
                    $this->rules['nameSchool'] = 'required';
                    $this->rules['lastYear'] = 'required|numeric';
                } else {
                    $this->showNewInput = false;
                    $this->rules['nameSchool'] = 'nullable';
                    $this->rules['lastYear'] = 'nullable';
                }   
            }

            public function showNewInput()
            {
                $this->showNewInput = true;
            }

            public function hideNewInput()
            {
                $this->showNewInput = false;
            }


        public function checkScholarshipLimit()
        {
            // Count the occurrences of the student_id in the funds table
            $studentIdCount = Fund::where('student_id', $this->student_id)->count();

            // Define the maximum limit for scholarship
            $maxLimit = 2;

            if ($studentIdCount >= $maxLimit) {
                $this->scholarshipLimitExceeded = true;
            } else {
                $this->scholarshipLimitExceeded = false;
            }
        }
        public function showHideFundSource()
        {
            if ($this->grant_status === 'No') {
                $this->selectedPrivateFundSources && $this->selectedGovernmentFundSources = null;
            }
        }


        public function saveStudent()
        {

            $this->validate();

                // Determine the scholarship and scholarship type based on grant_status
                list($scholarship, $scholarshipType) = $this->grant_status === 'Yes'
                ? $this->selectScholarshipAndType()
                : $this->defaultScholarshipAndType();

                $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();

                // Determine the source and source type based on the grant_status
                list($selectedFunds, $sourceName) = $this->grant_status === 'Yes'
                    ? $this->selectFundsAndSource()
                    : $this->defaultFundsAndSource();

                $studentData = [
                    'campus' => $campus->campusDesc,
                    'course' => $course->course_name,
                    'lastname' => $this->lastname,
                    'firstname' => $this->firstname,
                    'initial' => $this->initial,
                    'province' => $province->provDesc,
                    'municipal' => $municipality->citymunDesc,
                    'barangay' => $barangay->brgyDesc,
                    'sex' => $this->sex,
                    'status' => $this->status,
                    'contact' => $this->contact,
                    'email' => $this->email,
                    'student_id' => $this->student_id,
                    'level' => $this->level,
                    'semester' => $this->semester,
                    'studentType' => $this->studentType,
                    'nameSchool' => $this->nameSchool,
                    'lastYear' => $this->lastYear,
                    'grant_status' => $this->grant_status,
                    'grant' => $sourceName,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'scholarshipType' => $scholarshipType,
                ];

                $studentData = Student::create($studentData);

                 // Create Fund record based on the selectedFunds
                Fund::create([
                    'student_id' => $this->student_id,
                    'source_id' => $selectedFunds->source_id,
                ]);

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

        // Helper function to select the appropriate scholarship and scholarship type
        private function selectScholarshipAndType()
        {
            if ($this->selectedGovernmentScholarship) {
                $scholarship = ScholarshipName::findOrFail($this->selectedGovernmentScholarship);
            } else {
                $scholarship = ScholarshipName::findOrFail($this->selectedPrivateScholarship);
            }
            $scholarshipType = $scholarship->scholarship_type;
            return [$scholarship, $scholarshipType];
        }

        // Helper function to select the appropriate funds and source
        private function selectFundsAndSource()
        {
            if ($this->selectedGovernmentFundSources) {
                $selectedFunds = FundSource::findOrFail($this->selectedGovernmentFundSources);
            } else {
                $selectedFunds = FundSource::findOrFail($this->selectedPrivateFundSources);
            }
            $sourceName = $selectedFunds->source_name;
            return [$selectedFunds, $sourceName];
        }

        // Helper function for the default scholarship and scholarship type when grant_status is 'no'
        private function defaultScholarshipAndType()
        {
            $scholarship = ScholarshipName::findOrFail(1); // Change to the appropriate scholarship_id
            $scholarshipType = 0; // Set the default scholarship type
            return [$scholarship, $scholarshipType];
        }

        // Helper function for default funds and source when grant_status is 'no'
        private function defaultFundsAndSource()
        {
            $selectedFunds = FundSource::findOrFail(1); // Change to the appropriate source_id
            $sourceName = ''; // Set source name as empty
            return [$selectedFunds, $sourceName];
        }


        public function updatedSelectedGovernmentScholarship($value)
        {
            // When the selected government scholarship changes, fetch associated fund sources
            if ($value) {
                $this->selectedGovernmentFundSources = ScholarshipName::find($value)->fundSources->pluck('id')->toArray();
            } else {
                $this->selectedGovernmentFundSources = [];
            }
        }

        public function updatedSelectedPrivateScholarship($value)
        {
            // When the selected private scholarship changes, fetch associated fund sources
            if ($value) {
                $this->selectedPrivateFundSources = ScholarshipName::find($value)->fundSources->pluck('id')->toArray();
            } else {
                $this->selectedPrivateFundSources = [];
            }
        }

        public function fetchGovernmentScholarships()
        {
            // Fetch government scholarships
            $this->governmentScholars = ScholarshipName::where('scholarship_type', 0)->where('status', 0)->get();
        }

        public function fetchPrivateScholarships()
        {
            // Fetch private scholarships
            $this->privateScholars = ScholarshipName::where('scholarship_type', 1)->where('status', 0)->get();
        }



        public function render()
        {

            // Call the methods to fetch scholarship data
            $this->fetchGovernmentScholarships();
            $this->fetchPrivateScholarships();


            // Fetch campuses and courses
            $this->campuses = Campus::all();

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

            // $fund_sources = FundSource::all();
            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
                'governmentScholars' => $this->governmentScholars,
                'privateScholars' => $this->privateScholars,

            ]);
        }

            // Method to reset the form fields
            public function resetForm()
            {
                $this->selectedCampus = "";
                $this->selectedCourse = "";
                $this->lastname = "";
                $this->firstname = "";
                $this->initial = "";
                $this->sex = "";
                $this->status = "";
                $this->selectedProvince = "";
                $this->selectedMunicipality = "";
                $this->selectedBarangay = "";
                $this->contact = "";
                $this->email = "";
                $this->student_id = "";
                $this->level = "";
                $this->semester = "";
                $this->studentType = "";
                $this->nameSchool = "";
                $this->lastYear = "";
                $this->grant_status = "";
                $this->selectedGovernmentScholarship = "";
                $this->selectedGovernmentFundSources = "";
                $this->selectedPrivateScholarship = "";
                $this->selectedPrivateFundSources = "";
                $this->father = "";
                $this->mother = "";
                $this->showNewInput = false;
            }

    }
