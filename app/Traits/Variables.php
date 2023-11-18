<?php
namespace App\Traits;


trait Variables
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

    public $years, $selectedYear;

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

    public $grant;


    public function showNewInput()
    {
        $this->showNewInput = true;
    }

    public function hideNewInput()
    {
        $this->showNewInput = false;
    }
}
