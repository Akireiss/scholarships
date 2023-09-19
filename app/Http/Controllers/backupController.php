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
}
