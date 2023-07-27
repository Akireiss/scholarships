<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ScholarshipType;
use App\Models\ScholarshipName;
use App\Models\FundSource;
use Illuminate\Support\Facades\Redirect;

class ViewForm extends Component
{
    public $scholarship_type;
    public $scholarship_name;
    public $fund_sources;

    public function render()
    {

                // Fetch the data from the database
                $scholarshipTypes = ScholarshipType::all();
                $scholarshipNames = $this->getScholarshipNames();
                $fundSources = $this->getFundSources();

        return view('livewire.view-form', [
            'scholarshipTypes' => $scholarshipTypes,
            'scholarshipNames' => $scholarshipNames,
            'fundSources' => $fundSources,
        ]);
    }

    public function getScholarshipNames()
    {
        if ($this->scholarship_type) {
            return ScholarshipName::where('scholarship_type_id', $this->scholarship_type)->get();
        }

        return [];
    }

    public function getFundSources()
    {
        if ($this->scholarship_name) {
            return FundSource::where('scholarship_name_id', $this->scholarship_name)->get();
        }

        return [];
    }

    public function submit()
    {
        // Handle form submission if needed.
    }
}
