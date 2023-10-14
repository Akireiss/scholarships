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
    use Illuminate\Support\Facades\Redirect;


    class Grantees extends Component
    {
            public $selectedScholarship;
            // campus & course
            public $selectedCampus, $campuses;
            public $selectedCourse, $courses = [];

            public $governmentScholars = [],  $selectedScholarshipType;
            public $privateScholars = [];
            public $selectedGovernmentScholarship, $selectedPrivateFundSources = [];
            public $selectedPrivateScholarship, $selectedGovernmentFundSources = []; // Update the property name
            public $governmentFundSources = [], $privateFundSources = [] ;

            // Personal Information
            public $lastname, $firstname, $initial;
            public $sex, $status, $contact, $email, $level;
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
                'grant_status' => 'required',
                'studentType' => 'required',
                'father' => 'required',
                'mother' => 'required',
            ];


            public function updatedStudentType($value)
            {
                if ($value === 'new') {
                    $this->rules['nameSchool'] = 'required';
                    $this->rules['lastYear'] = 'required|numeric';
                } else {
                    unset($this->rules['nameSchool']);
                    unset($this->rules['lastYear']);
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
            // public function governmentScholarship($value)
            // {
            //     if ($value !== $this->selectedGovernmentScholarship) {
            //         $this->selectedScholarshipType = null;
            //     }
            // }
            // public function privateScholarship($value)
            // {
            //     if ($value !== $this->selectedPrivateScholarship) {
            //         $this->selectedScholarshipType = null;
            //     }
            // }


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
            if ($this->grant_status === 'no') {
                $this->selectedPrivateFundSources && $this->selectedGovernmentFundSources = null;
            }
        }


        public function saveStudent()
        {

            $this->validate();


                if ($this->selectedGovernmentScholarship) {
                    $scholarshipType = $this->selectedGovernmentScholarship;
                } elseif ($this->selectedPrivateScholarship) {
                    $scholarshipType = $this->selectedPrivateScholarship;
                }

                $studentData = [
                    'campus' => $this->selectedCampus,
                    'course' => $this->courses,
                    'lastname' => $this->lastname,
                    'firstname' => $this->firstname,
                    'initial' => $this->initial,
                    'province' => $this->selectedProvince,
                    'municipal' => $this->selectedMunicipality,
                    'barangay' => $this->selectedBarangay,
                    'sex' => $this->sex,
                    'status' => $this->status,
                    'contact' => $this->contact,
                    'email' => $this->email,
                    'student_id' => $this->student_id,
                    'level' => $this->level,
                    'studentType' => $this->studentType,
                    'last_school_attended' => $this->nameSchool,
                    'last_school_year' => $this->lastYear,
                    'grant_status' => $this->grant_status,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'scholarshipType' => $scholarshipType,
                ];

                $studentData = Student::create($studentData);

                // Save the selected fund source with the student ID in the fund table
                if ($this->grant_status === 'yes' && $this->selectedFundSources) {
                    foreach ($this->selectedFundSources as $sourceId) {
                        Fund::create([
                            'student_id' => $this->student_id,
                            'source_id' => $sourceId
                        ]);
                    }
                } elseif ($this->grant_status === 'no') {
                    // Automatically save source_id = 1 when grant_status is 'no'
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => 1 // Change this to the appropriate source_id value
                    ]);
                }

        session()->flash('success', 'Student data saved successfully!');
            // Reset the form fields
            $this->resetForm();

        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Add new student',
            'data' => json_encode('Added by '. $user->name),
        ]);
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
            $this->governmentScholars = ScholarshipName::where('scholarship_type', 0)->get();
        }

        public function fetchPrivateScholarships()
        {
            // Fetch private scholarships
            $this->privateScholars = ScholarshipName::where('scholarship_type', 1)->get();
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
                $this->studentType = "";
                $this->nameSchool = "";
                $this->lastYear = "";
                $this->grant_status = "";
                $this->father = "";
                $this->mother = "";

                $this->showNewInput = false;
            }

    }
