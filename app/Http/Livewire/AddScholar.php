<?php

namespace App\Http\Livewire;

use App\Models\FundSource;
use App\Models\ScholarshipName;
use App\Models\ScholarshipType;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AddScholar extends Component
{
    public $scholarshipTypes;
    public $scholarship_type_id;
    public $scholarship_name;
    public $fund_sources;
    public $successMessage = null;
    public $errorMessage = null;


    public function mount()
    {
        $this->scholarshipTypes = ScholarshipType::all();
    }

    public function updatedScholarshipType()
    {
        // Reset scholarship_name and fund_sources when the scholarship type is changed
        $this->scholarship_name = null;
        $this->fund_sources = null;
    }

    public function render()
    {
        $scholarshipTypes = ScholarshipType::all();

        return view('livewire.add-scholar', compact('scholarshipTypes'));
    }

public function submit()
{
        // Validate the form data
        $validator = Validator::make([
            'scholarship_type_id' => $this->scholarship_type_id,
            'scholarship_name' => $this->scholarship_name,
            'fund_sources' => $this->fund_sources,
        ], [
            'scholarship_type_id' => 'required',
            'scholarship_name' => 'required|string',
            'fund_sources' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Display an error message for validation failures
            $this->errorMessage = 'Please fill out all fields.';
            $this->successMessage = null;
            return;
        }

        // Create a new scholarship name record with the scholarship_type_id set properly
        $scholarshipName = ScholarshipName::create([
            'name' => $this->scholarship_name,
            'scholarship_type_id' => $this->scholarship_type_id,
        ]);

        // Create a new fund source record
        FundSource::create([
            'source_name' => $this->fund_sources,
            'scholarship_name_id' => $scholarshipName->id,
        ]);

        // Display the success message after successful form submission
        $this->successMessage = 'Scholarship information added successfully!';
        $this->errorMessage = null;

    // Clear the form fields after submission
    $this->reset(['scholarship_type_id', 'scholarship_name', 'fund_sources']);
}


}
