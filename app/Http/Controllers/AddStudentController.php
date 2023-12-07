<?php

namespace App\Http\Controllers;
// use App\Models\Course;
// use App\Models\Campus;
use App\Models\Student;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    public function grantees(Student $student)
    {

        return view('admin.scholarship.grantees', ['student' => $student]);
    }
    public function granteesStaff(Request $request)
    {
        return view('staff.scholarship.grantees'  );
    }
    public function granteesNLUC(Request $request)
    {
        return view('campus-NLUC.scholarship.grantees'  );
    }

}
