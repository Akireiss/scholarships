<?php

namespace App\Http\Livewire;

use Variables;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    public $students;

    public function mount()
    {
        $this->students = Student::with('grantee')->get();
    }

    public function render()
    {
        return view('livewire.students');
    }
}
