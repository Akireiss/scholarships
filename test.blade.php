{{-- <?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\ScholarshipName;
use App\Models\Fund;


class Grantees extends Component
{
    // campus&course
    public $selectedCampus;
    public $selectedCourse;
    public $courses = [];
    public $campuses;
    // Types
    public $scholarship_name;
    public $scholarships;
    public $selectedFundSources;
    public $funds;

        // Personal Information
        public $lastname;
        public $firstname;
        public $initial;
        public $sex;
        public $status;
        public $contact;
        public $email;
        public $level;
        public $nameSchool;
        public $lastYear;
        public $student_id;
        public $grant_status;
        public $grant;
        public $studentType;
        public $father;
        public $mother;

        // Address
        public $selectedProvince;
        public $selectedMunicipality;
        public $selectedBarangay;
        public $provinces = [];
        public $municipalities = [];
        public $barangays = [];

        // show&hide
        public $showNewInput = false;

        public function showNewInput()
        {
            $this->showNewInput = true;
        }

        public function hideNewInput()
        {
            $this->showNewInput = false;
        }


    public function saveStudent()
    {
           // Validate the student form fields
            $rules = [
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
            ];

            if ($this->studentType === 'new') {
                $rules['nameSchool'] = 'required';
                $rules['lastYear'] = 'required|numeric'; // Ensure lastYear is numeric
            }

            if ($this->grant_status === 'yes') {
                $rules['grant'] = 'required';
            }

            // Count the occurrences of the student_id in the funds table
            $studentIdCount = Fund::where('student_id', $this->student_id)->count();

            // Define the maximum limit for scholarship
            $maxLimit = 2;

            // Check if the student has reached the scholarship limit
            if ($studentIdCount >= $maxLimit) {
            // Display error message and return early
                session()->flash('error', 'The student has reached the maximum scholarship limit.');
                return;
            }

            $this->validate($rules);

            // Get the campus and course based on the selectedCampus and selectedCourse
            $campus = Campus::findOrFail($this->selectedCampus);
            $course = Course::findOrFail($this->selectedCourse);

            // Get the province, municipal, and barangay names based on their IDs
            $province = Province::findOrFail($this->selectedProvince);
            $municipality = Municipal::findOrFail($this->selectedMunicipality);
            $barangay = Barangay::findOrFail($this->selectedBarangay);

            // Save the student data
            $studentData = [
                'campus' => $campus->campus_name,
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
                'grant' => $this->grant,
                'father' => $this->father,
                'mother' => $this->mother,
            ];
            $student = Student::create($studentData);

            // Save the selected fund sources with the student ID in the fund table
            foreach ($this->selectedFundSources as $sourceId) {
                Fund::create([
                    'student_id' => $this->student_id,
                    'source_id' => $sourceId
                ]);
            }

        // Reset the form
        $this->resetForm();

        // Display success message and reload the page
        session()->flash('success', 'Student information saved successfully.');
        
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
        $this->provinces = Province::where('regCode', 1)->get();

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

        return view('livewire.grantees', [
            'campuses' => $this->campuses,
            'provinces' => $this->provinces,
        ]);
    }

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
     $this->selectedCampus = null;
     $this->selectedCourse = null;
     $this->lastname = null;
     $this->firstname = null;
     $this->initial = null;
     $this->sex = null;
     $this->status = null;
     $this->selectedProvince = null;
     $this->selectedMunicipality = null;
     $this->selectedBarangay = null;
     $this->contact = null;
     $this->email = null;
     $this->student_id = null;
     $this->level = null;
     $this->studentType = null;
     $this->nameSchool = null;
     $this->lastYear = null;
     $this->grant_status = null;
     $this->grant = null;
     $this->father = null;
     $this->mother = null;
     $this->selectedFundSources = [];

     $this->showNewInput = false;
 }

    }


    // 
                // Save the student data
            $studentData = [
                'campus' => $campus->campus_name,
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
                'grant' => $this->grant,
                'father' => $this->father,
                'mother' => $this->mother,
            ];
            $student = Student::create($studentData);



                    // Fetch provinces
        $this->provinces = Province::where('regCode', 1)->get();

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

                                    <div class="row">
                                <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>
                                <!-- Province Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" aria-label="Default select example"
                                        wire:model="selectedProvince">
                                        <option value="" selected>Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->provCode }}">{{ $province->provDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedProvince')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">City/Municipality</label>
                                    <select class="form-select" aria-label="Default select example"
                                        wire:model="selectedMunicipality">
                                        <option value="" selected>Select City</option>
                                        @foreach ($municipalities as $municipality)
                                            <option value="{{ $municipality->citymunCode }}">{{ $municipality->citymunDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedMunicipality')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Barangay Address -->
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select" aria-label="Default select example"
                                        wire:model="selectedBarangay">
                                        <option value="" selected>Select Barangay</option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay->brgyCode }}">{{ $barangay->brgyDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedBarangay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>