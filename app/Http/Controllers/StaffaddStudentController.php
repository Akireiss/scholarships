<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffaddStudentController extends Controller
{
        public function grantees(Request $request)
    {
        return view('staff.scholarship.grantees'  );
    }
}
