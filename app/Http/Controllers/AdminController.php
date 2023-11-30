<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // admin
    public function adminAdd()
    {
        return view('admin.actions.add_student');
    }
}
