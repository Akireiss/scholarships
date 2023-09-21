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
            // campus & course
            public $selectedCampus, $campuses;
            public $selectedCourse, $courses = [];
            // Types
            public $scholarship_name, $scholarships, $selectedScholarshipType;
            public $selectedFundSources, $funds, $selectedFundSource = null;

            // Personal Information
            public $lastname, $firstname, $initial;
            public $sex, $status, $contact, $email, $level;
            public $nameSchool, $lastYear;
            public $student_id,  $scholarshipLimitExceeded = false;
            public $grant_status = 'no', $grant, $fundSources;
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
                'contact' => 'required',
                'email' => 'required|email',
                'student_id' => 'required',
                'level' => 'required',
                'studentType' => 'required',
                'father' => 'required',
                'mother' => 'required',
                'selectedFundSources' => 'required',
            ];

            public function updatedStudentType($value)
            {
                if ($value === 'new') {
                    $this->rules['nameSchool'] = 'required';
                    $this->rules['lastYear'] = 'required|numeric'; // Ensure lastYear is numeric
                } else {
                    unset($this->rules['nameSchool']);
                    unset($this->rules['lastYear']);
                }
            }


                 public function updatedGrantStatus($value)
                    {
                        if ($value === 'yes') {
                            $this->rules['grant'] = 'required';
                        } else {
                            unset($this->rules['grant']);
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
            public function updatedScholarship_name($value)
            {
                if ($value !== $this->scholarship_name) {
                    $this->selectedScholarshipType = null;
                }
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
    if ($this->grant_status === 'no') {
        $this->selectedFundSource = null;
    }
}


        public function saveStudent()
        {
            $this->validate();


            try{


                // Get the campus and course based on the selectedCampus and selectedCourse
                $campus = Campus::findOrFail($this->selectedCampus);
                $course = Course::findOrFail($this->selectedCourse);

                // Get the province, municipal, and barangay names based on their IDs
                $province = Province::where('provCode', $this->selectedProvince)->firstOrFail();
                $municipality = Municipal::where('citymunCode', $this->selectedMunicipality)->firstOrFail();
                $barangay = Barangay::where('brgyCode', $this->selectedBarangay)->firstOrFail();

                    // Get the selected scholarship
        $scholarship = ScholarshipName::find($this->scholarship_name);

        if (!$scholarship) {
            session()->flash('error', 'Selected scholarship not found.');
            return;
        }

        // Get the associated scholarship type
        $scholarshipType = $scholarship->scholarshipType->name;

                // Save the student data
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
                    'studentType' => $this->studentType,
                    'last_school_attended' => $this->nameSchool,
                    'last_school_year' => $this->lastYear,
                    'grant_status' => $this->grant_status,
                    'father' => $this->father,
                    'mother' => $this->mother,
                    'scholarshipType' => $scholarshipType,
                ];

               // Check if grant status is 'yes' and a fund source is selected
                if ($this->grant_status === 'yes' && $this->selectedFundSource) {
                    $studentData['fund_source_id'] = $this->selectedFundSource;
                }

                $student = Student::create($studentData);


                // Save the selected fund sources with the student ID in the fund table
                foreach ($this->selectedFundSources as $sourceId) {
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => $sourceId
                    ]);
                }
                // Save the selected fund source with the student ID in the fund table
                if ($this->grant_status === 'yes' && $this->selectedFundSource) {
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => $this->selectedFundSource
                    ]);
                }

      // Flash a success message to the session
      session()->flash('success', 'Student data saved successfully!');
        // Reset the form fields
        $this->resetForm();

  } catch (\Exception $e) {
      // Flash an error message to the session
      session()->flash('error', 'An error occurred while saving the student data.');
              $this->resetForm();

  }

  $user = Auth::user();
//   record
AuditLog::create([
    'user_id' => $user->id,
    'action' => 'Add new student',
    'data' => json_encode(['Added by ' => $user->username]),
]);
}


        public function render()
        {
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

            // Fetch scholarships along with their types and fund sources
            $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();
            $this->fundSources = FundSource::all();

            return view('livewire.grantees', [
                'campuses' => $this->campuses,
                'provinces' => $this->provinces,
            ]);
        }

            // updatedSelectedFundSources method
            public function updatedSelectedFundSources()
            {
                // Ensure $this->selectedFundSources is an array
                if (!is_array($this->selectedFundSources)) {
                    $this->selectedFundSources = [];
                }

                // Limit the selection to 2 fund sources
                if (count($this->selectedFundSources) > 2) {
                    // Uncheck any additional selections beyond the first two
                    $this->selectedFundSources = array_slice($this->selectedFundSources, 1, 3); // Corrected slice parameters
                }
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
                $this->grant = "";
                $this->father = "";
                $this->mother = "";
                $this->selectedFundSources = "";

                $this->showNewInput = false;
            }

    }
