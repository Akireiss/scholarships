<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;

class NlucDash extends Component
{


    public $selectedType = 'Government';  // Default to 'Government'
    public $governmentCount = 0;
    public $privateCount = 0;

    public $selectedTypeScholar = 'Government';  // Default to 'Government'
    public $governmentScholar = 0;
    public $privateScholar = 0;
    public $chartData = [];

    public function mount()
    {
                // 2nd card
                if ($this->selectedTypeScholar === 'Government') {
                    $this->governmentScholar = Student::where('scholarshipType', 'Government')->count();
                } elseif ($this->selectedTypeScholar === 'Private') {
                    $this->privateScholar = Student::where('scholarshipType', 'Private')->count();
                } else {
                    $this->governmentScholar = 0;
                    $this->privateScholar = 0;
                }
                // linechart
                $this->chartData = Student::select('campus', DB::raw('count(*) as total'))
                ->groupBy('campus')
                ->get()
                ->toArray();

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


        return view('livewire.nluc-dash');
    }
}
