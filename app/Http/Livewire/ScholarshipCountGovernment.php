<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ScholarshipName;

class ScholarshipCountGovernment extends Component
{
    public $selectedType = 'Government';  // Default to 'Government'
    public $governmentCount = 0;
    public $privateCount = 0;

    public function render()
    {
        if ($this->selectedType === 'Government') {
            $this->governmentCount = ScholarshipName::whereHas('scholarshipType', function ($query) {
                $query->where('name', 'Government');
            })->count();
        } elseif ($this->selectedType === 'Private') {
            $this->privateCount = ScholarshipName::whereHas('scholarshipType', function ($query) {
                $query->where('name', 'Private');
            })->count();
        } else {
            $this->governmentCount = 0;
            $this->privateCount = 0;
        }

        return view('livewire.scholarship-count-government');
    }
}
