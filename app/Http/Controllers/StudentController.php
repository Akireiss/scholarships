<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function viewMore(Student $student)
    {
        return view('admin.scholarship.view_more', ['student' => $student]);
    }
}
