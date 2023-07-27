<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class auditController extends Controller
{
    public function audit()
    {
        return view('admin.settings.auditTrail');
    }
}
