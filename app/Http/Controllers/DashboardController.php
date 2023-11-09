<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function index1()
    {
        return view('staff.dashboardStaff');
    }
    public function index2()
    {
        return view('campus-NLUC.dashboardCamp');
    }
}
