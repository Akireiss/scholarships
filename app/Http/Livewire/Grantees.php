<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Request;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\ScholarshipName;
use App\Models\Fund;

class Grantees extends Component
{
    public $selectedCampus;
    public $selectedCourse;
    public $courses;
    // types
    public $scholarship_name;
    public $scholarships;
    public $selectedFundSources = [];

    public $lastname;
    public $firstname;
    public $initial;
    public $sex;
    public $status;
    public $contact;
    public $email;
    public $student_id;
    public $grant_status;
    public $studentType;
    // address
    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = [];
    public $barangays = [];


   // address   // address
    public function updatedSelectedProvince($provinceId)
    {
        $this->municipalities = Municipal::where('province_id', $provinceId)->get();
        $this->selectedMunicipality = null;
        $this->selectedBarangay = null;
        $this->barangays = [];
    }

    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangay = null;
    }

    // end here
    public function saveStudent()
    {
        // Validate the student form fields
        $this->validate([
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
            'student_id' => 'required|unique:students,student_id', // Ensure unique student ID
            'level' => 'required',
            'studentType' => 'required',
            'nameSchool' => 'required_if:studentType,new',
            'lastYear' => 'required_if:studentType,new',
            'grant_status' => 'required',
            'grant' => 'required_if:grant_status,yes',
        ]);

        // Get the campus name based on the selectedCampus
        $campus = Campus::findOrFail($this->selectedCampus);

        // Get the course name based on the selectedCourse
        $course = Course::findOrFail($this->selectedCourse);

        // Get the province, municipal, and barangay names based on their IDs
        $province = Province::findOrFail($this->selectedProvince);
        $municipality = Municipal::findOrFail($this->selectedMunicipality);
        $barangay = Barangay::findOrFail($this->selectedBarangay);


        // Save the student data
        $student = Student::create([
            'campus_name' => $campus->campus_name,
            'course_name' => $this->selectedCourse,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'middle_initial' => $this->initial,
            'province' => $province->province_name,
            'municipal' => $municipality->municipal_name,
            'barangay' => $barangay->barangay_name,
            'sex' => $this->sex,
            'civil_status' => $this->status,
            'contact_number' => $this->contact,
            'email' => $this->email,
            'student_id' => $this->student_id,
            'year_level' => $this->level,
            'student_type' => $this->studentType,
            'last_school_attended' => $this->nameSchool,
            'last_school_year' => $this->lastYear,
            'grant_status' => $this->grant_status,
            'grant_details' => $this->grant,
        ]);
                // Save the selected fund sources with the student ID in the fund table
                foreach ($this->selectedFundSources as $sourceId) {
                    Fund::create([
                        'student_id' => $this->student_id,
                        'source_id' => $sourceId
                    ]);
                }

        // Optionally, you can reset the form fields after saving the data
        $this->reset();

        // Optionally, you can redirect the user to a success page or show a success message.
        session()->flash('success', 'Student data saved successfully!');
    }
    //




    public function render()
    {
        $provinces = Province::all();
        $campuses = Campus::all();
        $this->courses = [];
        // address

//   end here


        if ($this->selectedCampus) {
            $campus = Campus::findOrFail($this->selectedCampus);
            $this->courses = $campus->courses;
        }

        // Fetch scholarships along with their types and fund sources
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();

        return view('livewire.grantees', [
            'campuses' => $campuses,
            'provinces' => $provinces
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

    // adresssss

    }
