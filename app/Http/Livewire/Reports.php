<?php

namespace App\Http\Livewire;

use App\Models\Campus;

use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\SchoolYear;

class Reports extends Component
{

    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay, $years;
    public $selectedYear;


    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
    }
    public function render()
    {
        $this->fetchSchoolYears();


    $users = auth()->user()->role;
    if($users == 1){
        $campuses = Campus::all();
    }elseif ($users == 0){
        $campuses = Campus::all();
    } else{
        $campuses = Campus::where('campus_name', 'NLUC');
    }

    // Fetch all provinces where regCode is 1
    $provinces = Province::where('regCode', 1)->get();

    // Fetch municipalities based on the selected province
    $municipalities = [];
    if ($this->selectedProvince) {
        $municipalities = Municipal::where('provCode', $this->selectedProvince)->get();
    }

    // Fetch barangays based on the selected municipality
    $barangays = [];
    if ($this->selectedMunicipality) {
        $barangays = Barangay::where('citymunCode', $this->selectedMunicipality)->get();
    }

    return view('livewire.reports', [
        'provinces' => $provinces,
        'municipalities' => $municipalities,
        'barangays' => $barangays,
        'campuses' => $campuses,
        'years' => $this->years,
    ]);
    }
}
