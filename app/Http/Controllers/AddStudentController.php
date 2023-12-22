<?php

namespace App\Http\Controllers;
// use App\Models\Course;
// use App\Models\Campus;
use App\Models\Student;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    public function grantees()
    {

        return view('admin.scholarship.grantees');
    }
    public function searchAdmin()
    {
        return view('admin.scholarship.grantees_search');
    }



    public function granteesStaff()
    {
        return view('staff.scholarship.grantees'  );
    }
    public function granteesNLUC()
    {
        return view('campus-NLUC.scholarship.grantees'  );
    }

}
