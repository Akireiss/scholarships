<?php

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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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
    public $selectedFundSources = [];

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



    // end here
    public function saveStudent()
    {
        // dd($this->all());
        try{
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
                'student_id' => 'required', // Ensure unique student ID
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
            $this->validate($rules);

                    // Check if the student exists before checking scholarship limit
                    $student = Student::where('student_id', $this->student_id)->first();
                    if ($student && $student->funds && $student->funds->count() >= 2) {
                        $this->addError('error', 'The student has reached the scholarship limit of 2.');
                        return;
                    }

            // Get the campus and course based on the selectedCampus and selectedCourse
            $campus = Campus::findOrFail($this->selectedCampus);
            $course = Course::findOrFail($this->selectedCourse);

            // Get the province, municipal, and barangay names based on their IDs
            $province = Province::findOrFail($this->selectedProvince);
            $municipality = Municipal::findOrFail($this->selectedMunicipality);
            $barangay = Barangay::findOrFail($this->selectedBarangay);

            // Save the student data
            $student = Student::create([
                'campus' => $campus->campus_name,
                'course' => $course->course_name,
                'lastname' => $this->lastname,
                'firstname' => $this->firstname,
                'initial' => $this->initial,
                'province' => $province->name,
                'municipal' => $municipality->name,
                'barangay' => $barangay->name,
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
            ]);

            // Save the selected fund sources with the student ID in the fund table
            foreach ($this->selectedFundSources as $sourceId) {
                Fund::create([
                    'student_id' => $this->student_id,
                    'source_id' => $sourceId
                ]);
            }
            session()->flash('success', 'Student information saved successfully.');
            $this->resetForm();

        // Emit the Livewire event to trigger page reload
        $this->emit('reloadPage');

        // // Redirect to the current page
        // return Redirect::back();
    } catch (\Exception $e) {
        // Log the error or perform appropriate error handling
        // dd($e->getMessage()); // Debugging output to see the exception message
        return back()->withErrors(['error' => 'An error occurred while saving the data.']);
    }
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
        $this->provinces = Province::all();

        // Fetch municipalities and barangays based on the selected province and municipality
        if ($this->selectedProvince) {
            $this->municipalities = Municipal::where('province_id', $this->selectedProvince)->get();
        } else {
            $this->municipalities = [];
        }

        if ($this->selectedMunicipality) {
            $this->barangays = Barangay::where('municipal_id', $this->selectedMunicipality)->get();
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
        // Limit the selection to 2 fund sources
        if (count($this->selectedFundSources) > 2) {
            // Uncheck any additional selections beyond the first two
            $this->selectedFundSources = array_slice($this->selectedFundSources, 1, 3);
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
