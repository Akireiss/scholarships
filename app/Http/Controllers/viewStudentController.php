<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewStudentController extends Controller
{
    public function studentAdmin()
    {
        return view('admin.scholarship.student-view');
    }
    public function studentStaff()
    {
        return view('staff.scholarship.student-view');
    }
    public function studentCampus()
    {
        return view('campus-NLUC.scholarship.student-view');
    }
}
