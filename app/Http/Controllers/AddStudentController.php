<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Campus;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    public function grantees(Request $request)
    {
        // Pass the campuses, courses, and selected campus data to the view
        return view('admin.scholarship.grantees'  );
    }
    public function granteesStaff(Request $request)
    {
        return view('staff.scholarship.grantees'  );
    }

}
