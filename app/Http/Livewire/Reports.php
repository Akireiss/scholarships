<?php

namespace App\Http\Livewire;

// use Illuminate\Support\Facades\Facade\Log;
use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Models\FundSource;
use App\Models\SchoolYear;
use App\Exports\StudentsExport;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


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


    $user = Auth::user();

    $data = Student::query();

    // Add a condition to restrict downloads based on user role and campus
    if ($user->role == 2 && $this->selectedCampus == 'Don Mariano Marcos Memorial State University North La Union Campus') {
        $data->where('campus', $this->selectedCampus);
    }

    $this->applyFilters($data);

    // Required condition for school_year
    $data->where('school_year', $this->selectedYear);

    // Get the final result
    $data = $data->get();

    // Generate a more descriptive filename
    $filename = 'student.xlsx';

    // Create a unique filename for the export
    $export = new StudentsExport($data);

    // Provide the download response directly to the user's browser
    return Excel::download($export, $filename);
}


}
