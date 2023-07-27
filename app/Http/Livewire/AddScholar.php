<?php

namespace App\Http\Livewire;

use App\Models\FundSource;
use App\Models\ScholarshipName;
use Livewire\Component;

class AddScholar extends Component
{

    public $scholarshipType;
    public $scholarshipName;
    public $fund_source;


    public function render()
    {
        $scholarshipNames = ScholarshipName::where('scholarship_type_id', $this->scholarshipType)->get();
        $fund_sources = FundSource::where('scholarship_name_id', $this->scholarshipName)->get();;
        return view('livewire.add-scholar', compact('scholarshipNames', 'fund_sources'));
    }

    public function store()
    {
        $this->validate([
            'scholarshipType' => 'required|in:Government,Private',
            'scholarshipName' => 'required|exist:scholarship_name_id',
            'fund_source'     => 'required|source_id',

        ]);
    }
}
