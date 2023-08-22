<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class studentViewController extends Controller
{
    public function adminView($id)
    {
            // Retrieve the student model using the provided ID
            $student = Student::find($id);



        return view('admin.scholarship.student-view',['student' => $student]);
    }
}
