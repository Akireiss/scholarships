<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentData extends Component
{

    public $students;
    public $sourceName;

    public function mount($students, $sourceName)
    {
        // Set the students and source name properties
        $this->students = $students;
        $this->sourceName = $sourceName;
    }

    public function render()
    {
        return view('livewire.student-data', [
            'students' => $this->students,
            'sourceName' => $this->sourceName,
        ]);
    }
    
}
