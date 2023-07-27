<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCampController extends Controller
{
    public function index()
    {
        return view('campus-NLUC.dashboardCamp');
    }
}
