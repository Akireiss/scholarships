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
    $this->students = Student::join('barangays', 'students.barangay', '=', 'barangays.brgyCode')
        ->join('municipals', 'students.municipal', '=', 'municipals.citymunCode')
        ->join('provinces', 'students.province', '=', 'provinces.provCode')
        ->join('campuses', 'students.campus', '=', 'campuses.id')
        ->join('courses', 'students.course', '=', 'courses.course_id') // Update join condition
        ->leftJoin('grantees', 'students.id', '=', 'grantees.student_id')
        ->select('students.*', 'barangays.brgyDesc', 'municipals.citymunDesc', 'provinces.provDesc', 'campuses.campusDesc', 'courses.course_name', 'grantees.semester', 'grantees.school_year', 'grantees.scholarship_name')
        ->get();

    return view('livewire.students', [
        'students' => $this->students,
    ]);
}

}
