<?php

namespace App\Http\Livewire;

use App\Models\ScholarshipName;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use Livewire\Request;

class Grantees extends Component
{
    public $selectedCampus;
    public $selectedCourse;
    public $courses;
    public $scholarships;
    public $selectedFundSources = [];
    public $scholarship_name;
    public $selectedScholarship;

    public $lastname;
    public $firstname;
    public $initial;
    public $province;
    public $municipal;
    public $barangay;
    public $sex;
    public $status;
    public $contact;
    public $email;
    public $level;
    public $studentType;
    public $nameSchool;
    public $lastYear;
    public $scholarshipName;



    protected $rules = [
        'selectedCampus' => 'required',
        'selectedCourse' => 'required',
        'lastname' => 'required',
        'firstname' => 'required',
        'initial' => 'required',
        'province' => 'required',
        'municipal' => 'required',
        'barangay' => 'required',
        'sex' => 'required',
        'status' => 'required',
        'contact' => 'required',
        'email' => 'required|email',
        'level' => 'required',
        'studentType' => 'required',
        'nameSchool' => 'required_if:studentType,new',
        'lastYear' => 'required_if:studentType,new',
        'scholarship_name' => 'required',
        'selectedFundSources' => 'required',
    ];

    public function mount()
    {
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();
    }
    

    public function render()
    {
        $campuses = Campus::all();

        $this->courses = [];

        if ($this->selectedCampus) {
            $campus = Campus::findOrFail($this->selectedCampus);
            $this->courses = $campus->courses;
        }

        // Fetch scholarships along with their types and fund sources
        $this->scholarships = ScholarshipName::with('scholarshipType', 'fundSources')->get();

        return view('livewire.grantees', [
            'campuses' => $campuses,
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

    }
