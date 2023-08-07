<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Student;
use Livewire\Component;
use App\Models\FundSource;
use App\Models\ScholarshipName;
use App\Models\ScholarshipType;
use Illuminate\Support\Facades\DB;


class ViewForm extends Component
{

    public $scholarshipTypes;
    public $scholarshipNames;
    public $fundSources;
    public $selectedType;
    public $selectedName;
    public $selectedSource;
    public $students;
    public $sourceName;

    public function mount()
    {
        // Retrieve data from the database
        $this->scholarshipTypes = ScholarshipType::all();
        $this->scholarshipNames = collect();
        $this->fundSources = collect();
    }

    public function updatedSelectedType($value)
    {
        // Update the scholarship names based on the selected scholarship type
        if ($value) {
            $this->scholarshipNames = ScholarshipName::where('scholarship_type_id', $value)->get();
        } else {
            $this->scholarshipNames = collect();
        }
        // Reset the selected scholarship name and fund source
        $this->selectedName = null;
        $this->selectedSource = null;
    }

    public function updatedSelectedName($value)
    {
        // Update the fund sources based on the selected scholarship name
        if ($value) {
            $this->fundSources = FundSource::where('scholarship_name_id', $value)->get();
        } else {
            $this->fundSources = collect();
        }
        // Reset the selected fund source
        $this->selectedSource = null;
    }

    public function submit()
    {
        // Retrieve students based on the selected source of funds
        $students = Student::whereHas('funds', function ($query) {
            $query->where('source_id', $this->selectedSource);
        })->get();

        // Retrieve the name of the selected source of funds
        $sourceName = FundSource::find($this->selectedSource)->source_name;

        // Redirect to the student data route with the students and source name as parameters
        return redirect()->route('livewire.student-data', ['students' => $students, 'sourceName' => $sourceName] );
    }

    public function render()
    {
        return view('livewire.view-form');
    }
}
