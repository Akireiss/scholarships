<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\FundSource;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Auth;

class NlucGrantees extends Component
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



        public function saveStudent()
      {

            $this->validate();

            // Determine the government scholarship and scholarship type based on the selected government scholarship
            list($governmentScholarship, $governmentScholarshipType) = $this->selectGovernmentScholarshipAndType();

            // Determine the private scholarship and scholarship type based on the selected private scholarship
            list($privateScholarship, $privateScholarshipType) = $this->selectPrivateScholarshipAndType();

              $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();

            // Determine the source and source type based on the selected funds
            list($selectedFunds, $sourceName) = $this->selectFundsAndSource();

            $governmentStudentData = [
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
                    'grant' => $sourceName,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'scholarshipType' => $governmentScholarshipType,
                ];

                $governmentStudent = Student::create($governmentStudentData);
                if ($selectedFunds) {
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => $selectedFunds->source_id,
                    ]);
                }


                  // If private scholarship is selected, create a separate Student record for the private scholarship
    if ($this->selectedPrivateScholarship) {
        // Determine the source and source type based on the selected private funds
        list($privateSelectedFunds, $privateSourceName) = $this->selectPrivateFundsAndSource();

        $privateStudentData = [
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
            'grant' => $privateSourceName,
            'father' => $this->father,
            'mother' => $this->mother,
            'scholarshipType' => $privateScholarshipType,
        ];

        $privateStudent = Student::create($privateStudentData);

        // Create Fund record based on the selected funds for the private scholarship
        if ($privateSelectedFunds) {
            Fund::create([
                'student_id' => $this->student_id,
                'source_id' => $privateSelectedFunds->source_id,
            ]);
        }
    }



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

     // Helper function to select the appropriate government scholarship and scholarship type
        private function selectGovernmentScholarshipAndType()
        {
            $governmentScholarship = ScholarshipName::findOrFail($this->selectedGovernmentScholarship);
            $governmentScholarshipType = $governmentScholarship->scholarship_type;
            return [$governmentScholarship, $governmentScholarshipType];
        }

        // Helper function to select the appropriate private scholarship and scholarship type
        private function selectPrivateScholarshipAndType()
        {
            if ($this->selectedPrivateScholarship) {
                $privateScholarship = ScholarshipName::findOrFail($this->selectedPrivateScholarship);
                $privateScholarshipType = $privateScholarship->scholarship_type;
            } else {
                $privateScholarship = null;
                $privateScholarshipType = null;
            }
            return [$privateScholarship, $privateScholarshipType];
        }

            // Helper function to select the appropriate funds and source
    private function selectFundsAndSource()
    {
        if ($this->selectedGovernmentScholarship) {
            $selectedFunds = FundSource::findOrFail($this->selectedGovernmentScholarship);
        } else {
            $selectedFunds = null;
        }
        $sourceName = $selectedFunds ? $selectedFunds->source_name : null;
        return [$selectedFunds, $sourceName];
    }
        // Helper function to select the appropriate private funds and source
        private function selectPrivateFundsAndSource()
        {
            if ($this->selectedPrivateFundSources) {
                $privateSelectedFunds = FundSource::findOrFail($this->selectedPrivateFundSources);
            } else {
                $privateSelectedFunds = null;
            }
            $privateSourceName = $privateSelectedFunds ? $privateSelectedFunds->source_name : null;
            return [$privateSelectedFunds, $privateSourceName];
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
            $this->campuses = Campus::where('campus_name', 'NLUC')->get();

            if ($this->selectedCampus) {
                $campus = Campus::findOrFail($this->selectedCampus);
                $this->courses = $campus->courses;
            } else {
                // $this->campuses = [];
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
            return view('livewire.nluc-grantees', [
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
                $this->selectedGovernmentScholarship = "";
                $this->selectedPrivateScholarship = "";
                $this->selectedGovernmentFundSources = [];
                $this->selectedPrivateFundSources = [];
                $this->father = "";
                $this->mother = "";
                $this->showNewInput = false;
            }

    }


