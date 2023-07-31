<?php

namespace App\Http\Livewire;

use Livewire\Request;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\ScholarshipName;

class Grantees extends Component
{
    public $selectedCampus;
    public $selectedCourse;
    public $courses;
    public $scholarships;
    public $selectedFundSources = [];
    public $scholarship_name;
    public $selectedScholarship;

    // public $lastname;
    // public $firstname;
    // public $initial;

    // public $sex;
    // public $status;
    // public $contact;
    // public $email;
    // public $level;
    // public $studentType;
    // public $nameSchool;
    // public $lastYear;
    public $scholarshipName;



    // protected $rules = [
    //     'selectedCampus' => 'required',
    //     'selectedCourse' => 'required',
    //     'lastname' => 'required',
    //     'firstname' => 'required',
    //     'initial' => 'required',
    //     'province' => 'required',
    //     'municipal' => 'required',
    //     'barangay' => 'required',
    //     'sex' => 'required',
    //     'status' => 'required',
    //     'contact' => 'required',
    //     'email' => 'required|email',
    //     'level' => 'required',
    //     'studentType' => 'required',
    //     'nameSchool' => 'required_if:studentType,new',
    //     'lastYear' => 'required_if:studentType,new',
    //     'scholarship_name' => 'required',
    //     'selectedFundSources' => 'required',
    // ];


    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = []; // Initialize as empty array
    public $barangays = [];

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


    public function mount()
    {
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();
    }


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
