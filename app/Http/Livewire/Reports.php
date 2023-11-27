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
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{
    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
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
    public $years;

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
        ]);


        // Fetch data based on the selected input fields
        $data = Student::query();
     

        $this->applyFilters($data);

        // Required condition for school_year
        $data->where('school_year', $this->selectedYear);

        // Get the final result
        $data = $data->get();
        // dd($data); 

       // Generate a more descriptive filename
    $filename = 'student.xlsx';

    // Create a unique filename for the export
    $export = new StudentsExport($data);

    // Provide the download response directly to the user's browser
    return Excel::download($export, $filename);
    }




    private function applyFilters($data)
    {
        if ($this->selectedProvince) {
            $data->where('province', $this->selectedProvince);
        }

        if ($this->selectedMunicipality) {
            $data->where('municipal', $this->selectedMunicipality);
        }

        if ($this->selectedBarangay) {
            $data->where('barangay', $this->selectedBarangay);
        }

        if ($this->selectedCampus) {
            $data->where('campus', $this->selectedCampus);
        }

        if ($this->semester) {
            $data->where('semester', $this->semester);
        }

        if ($this->source_funds) {
            $data->where('grant', $this->source_funds);
        }
    }

    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(5)->get();
    }

    public function fetchCampuses()
    {
        $users = auth()->user()->role;
        $this->campuses = ($users == 1 || $users == 0) ? Campus::all() : Campus::where('campus_name', 'NLUC')->get();
    }

    public function fetchProvinces()
    {
        $this->provinces = Province::where('regCode', 1)->get();
    }

    public function fetchMunicipalities()
    {
        $this->municipalities = $this->selectedProvince ? Municipal::where('provCode', $this->selectedProvince)->get() : [];
    }

    public function fetchBarangays()
    {
        $this->barangays = $this->selectedMunicipality ? Barangay::where('citymunCode', $this->selectedMunicipality)->get() : [];
    }

    public function fetchSourceFunds()
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
