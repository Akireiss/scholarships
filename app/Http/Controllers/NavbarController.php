<?php

namespace App\Http\Controllers;

use DataTimeZone;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavbarController extends Controller
{
    public function notification() {
 

        return view('layouts.includes.admin.navbar');


    }
}
