<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addScholarController extends Controller
{
    public function showForm()
    {
        return view('admin.settings.addScholar');
    }

    // staff
    public function showFormStaff()
    {
        return view('staff.settings.addScholar');
    }

    // campus-NLUC

    public function showFormNLUC()
    {
        return view('campus-NLUC.settings.addScholar');
    }

}
