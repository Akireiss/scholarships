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
=======
        // Fetch data based on the selected input fields
        $data = Student::query();

        if ($this->selectedProvince) {
            $data->where('province', $this->selectedProvince);
        }

        if ($this->selectedMunicipality) {
            $data->where('municipality', $this->selectedMunicipality);
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

        if ($this->selectedYear) {
            $data->where('school_year', $this->selectedYear);
        }

        // Add more conditions based on other input fields

        // Get the final result
        $data = $data->get();

        // Create a CSV file with the data
        $csvFileName = 'students_report.csv';
        $csvFile = fopen($csvFileName, 'w');

        // Add headers to the CSV file
        fputcsv($csvFile, array_keys($data->first()->toArray()));

        // Add data to the CSV file
        foreach ($data as $row) {
            fputcsv($csvFile, $row->toArray());
        }

        fclose($csvFile);

        // Set the headers for the download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename="' . $csvFileName . '"',
            'Cache-Control' => 'max-age=0',
        ];

        session()->flash('success', 'Report generated successfully');
        // Download the file
        return response()->download($csvFileName, $csvFileName, $headers);

        // Optionally, you can add a success message

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
>>>>>>> 3f0f5ac1bc9ed7421a44f81f4f49442e91988710
}
