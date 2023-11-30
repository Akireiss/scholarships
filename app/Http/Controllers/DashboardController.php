<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
