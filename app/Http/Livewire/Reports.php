<?php

namespace App\Http\Livewire;


use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\FundSource;
use App\Models\SchoolYear;
use App\Models\ScholarshipName;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;




class Reports extends Component
{

    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay, $years;
    public $selectedCampus;
    public $semester;
    public $selectedYear;
    public $scholarship_type;
    public $source_funds;
    public $students;
    public $campuses;
    public $provinces;
    public $municipalities;
    public $barangays;
    public $sourceFunds;



    public function mount()
    {
        $this->fetchSchoolYears();
        $this->fetchCampuses();
        $this->fetchProvinces();
    }

    public function render()
    {
        $this->fetchMunicipalities();
        $this->fetchBarangays();
        $this->fetchSourceFunds();

        return view('livewire.reports', [
            'provinces' => $this->provinces,
            'municipalities' => $this->municipalities,
            'barangays' => $this->barangays,
            'campuses' => $this->campuses,
            'years' => $this->years,
            'sourceFunds' => $this->sourceFunds,
        ]);
    }

    public function generateReport()
    {
        // Validate the selectedYear and other fields if needed
        $this->validate([
            'selectedYear' => 'required',
            // Add other validation rules as needed
        ]);

        // Fetch data based on the selected input fields, replace this with your actual query
        $data = Student::where(function ($query) {
            // Add conditions based on selected input fields

            if ($this->selectedProvince) {
                $query->where('province', $this->selectedProvince);
            }

            if ($this->selectedMunicipality) {
                $query->where('municipality', $this->selectedMunicipality);
            }

            if ($this->selectedBarangay) {
                $query->where('barangay', $this->selectedBarangay);
            }

            if ($this->selectedCampus) {
                $query->where('campus', $this->selectedCampus);
            }

            if ($this->semester) {
                $query->where('semester', $this->semester);
            }

            if ($this->selectedYear) {
                $query->where('school_year', $this->selectedYear);
            }

            // Add more conditions based on other input fields

        })->get();


        // Generate the Excel report
        // return Excel::download(new StudentsExport($data), 'students_report.xlsx');
    }


            private function fetchSchoolYears()
            {
                $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
            }

            private function fetchCampuses()
            {
                $users = auth()->user()->role;
                $this->campuses = ($users == 1 || $users == 0) ? Campus::all() : Campus::where('campus_name', 'NLUC')->get();
            }

            private function fetchProvinces()
            {
                $this->provinces = Province::where('regCode', 1)->get();
            }

            private function fetchMunicipalities()
            {
                $this->municipalities = $this->selectedProvince ? Municipal::where('provCode', $this->selectedProvince)->get() : [];
            }

            private function fetchBarangays()
            {
                $this->barangays = $this->selectedMunicipality ? Barangay::where('citymunCode', $this->selectedMunicipality)->get() : [];
            }

            private function fetchSourceFunds()
            {
                if ($this->scholarship_type !== null) {
                    $scholarshipIds = ScholarshipName::where('scholarship_type', $this->scholarship_type)->pluck('id');

                    if ($scholarshipIds->isNotEmpty()) {
                        $this->sourceFunds = FundSource::whereIn('scholarship_name_id', $scholarshipIds)->get();
                    }
                } else {
                    $this->sourceFunds = collect(); // Empty collection if no scholarship type selected
                }
            }




}
