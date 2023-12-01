<?php

namespace App\Http\Livewire;

use Variables;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    public $students;

    public function render()
    {
        $this->students = Student::with('grantee')->get();
        return view('livewire.students',[
            'students' => $this->students,
        ]);
    }
}
