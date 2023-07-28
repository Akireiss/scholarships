<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class auditController extends Controller
{
    // admin
    public function audit()
    {
        return view('admin.settings.auditTrail');
    }
    // staff
    public function auditStaff()
    {
        return view('staff.settings.auditTrail');
    }
}
