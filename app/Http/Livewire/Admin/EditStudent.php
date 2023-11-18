<?php

namespace App\Http\Livewire\Admin;

use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\Province;
use App\Traits\Variables;
use App\Models\Municipal;
use App\Models\Barangay;

class EditStudent extends Component
{
    use Variables;
    public $student;



    public function mount($student) {
    $this->student =  Student::findOrFail($student);
    //Compoents
    $this->student_id = $this->student->student_id;
    $this->lastname = $this->student->lastname;
    $this->firstname = $this->student->firstname;
    $this->initial = $this->student->initial;
    $this->email = $this->student->email;
    $this->sex = $this->student->sex;
    $this->status = $this->student->status;
    $this->barangays = $this->student->barangays;
    $this->municipalities = $this->student->municipalities;
    $this->province = $this->student->province;
    $this->campuses = $this->student->campus;
    $this->selectedCourse = $this->student->selectedCourse;
    $this->level = $this->student->level;
    $this->semester = $this->student->semester;
    $this->father = $this->student->father;
    $this->mother = $this->student->mother;
    $this->contact = $this->student->contact;
    $this->studentType = $this->student->studentType;
    $this->nameSchool = $this->student->nameSchool;
    $this->lastYear = $this->student->lastYear;
    $this->grant = $this->student->grant;
    $this->scholarshipType = $this->student->scholarshipType;

    }
    public function render()
    {


        // $campuses = Campus::all();
        return view('livewire.admin.edit-student',
        [
            // 'provices' => $this->provinces,
            'campuses' => Campus::all(),

        ])
        ->extends('layouts.includes.admin.index')
        ->section('content');

    }

}
