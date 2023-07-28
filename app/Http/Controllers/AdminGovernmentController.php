<?php

namespace App\Http\Controllers;


class AdminGovernmentController extends Controller
{
    // admin
    public function view()
    {
        return view('admin.scholarship.view');
    }
    // staff
    public function viewStaff()
    {
        return view('staff.scholarship.view');
    }
    // campus


}

