<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStaffController extends Controller
{
    public function index()
    {
        return view('staff.dashboardStaff');
    }
}
