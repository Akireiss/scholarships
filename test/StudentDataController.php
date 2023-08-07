<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentDataController extends Controller
{
    public $students;
    public $sourceName;

    public function mount($students, $sourceName)
    {
        // Set the students and source name properties
        $this->students = $students;
        $this->sourceName = $sourceName;
    }
    public function data()
    {
    
        return view('livewire.student-data', compact('students', 'sourceName'));
    }
}
