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
use App\Exports\StudentsExport;
use App\Models\ScholarshipName;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




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
        ]);

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
}
