<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // View More
    public function viewMore(Student $student)
    {
        return view('admin.scholarship.actions.view_more', ['student' => $student]);
    }
    public function viewMoreStaff(Student $student)
    {
        return view('staff.scholarship.view_more', ['student' => $student]);
    }
    public function viewMoreNLUC(Student $student)
    {
        return view('campus-NLUC.scholarship.view_more', ['student' => $student]);
    }

    // Update

    public function editAdmin(Student $student)
    {
        return view('admin.scholarship.actions.edit_student', ['student' => $student]);
    }

}
