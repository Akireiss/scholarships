<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backupController extends Controller
{
    // admin
    public function adminBackup()
    {

        return view('admin.settings.backup');
    }


    // staff
    public function staffBackup()
    {

        return view('staff.settings.backup');
    }

    // NLUC
    public function nlucBackup()
    {

        return view('campus-NLUC.settings.backup');
    }
}

