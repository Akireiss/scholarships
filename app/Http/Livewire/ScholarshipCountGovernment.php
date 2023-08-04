<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\ScholarshipName;

class ScholarshipCountGovernment extends Component
{
    public $selectedType = 'Government';  // Default to 'Government'
    public $governmentCount = 0;
    public $privateCount = 0;

    public $selectedTypeScholar = 'Government';  // Default to 'Government'
    public $governmentScholar = 0;
    public $privateScholar = 0;

    public function mount()
{
            // 2nd card
            if ($this->selectedTypeScholar === 'Government') {
                $this->governmentScholar = Student::where('scholarshipType', 1)->count();
            } elseif ($this->selectedTypeScholar === 'Private') {
                $this->privateScholar = Student::where('scholarshipType', 2)->count();
            } else {
                $this->governmentScholar = 0;
                $this->privateScholar = 0;
            }
}


    public function render()
    {
        // 1st card
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
