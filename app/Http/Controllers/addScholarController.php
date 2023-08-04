<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addScholarController extends Controller
{
    public function showForm()
    {
        return view('admin.settings.addScholar');
    }

    public function submitForm(Request $request)
    {
        //message
        return redirect()->route('admin.settings.addScholar')->with('success', 'Scholarship application submitted successfully!');
    }

    // staff
    public function showFormStaff()
    {
        return view('staff.settings.addScholar');
    }

    public function submitFormStaff(Request $request)
    {
        //message
        return redirect()->route('staff.settings.addScholar')->with('success', 'Scholarship application submitted successfully!');
    }

    // campus-NLUC

    // public function showFormNLUC()
    // {
    //     return view('campus-NLUC.settings.addScholar');
    // }

    // public function submitFormNLUC(Request $request)
    // {
    //     //message
    //     return redirect()->route('campus-NLUC.settings.addScholar')->with('success', 'Scholarship application submitted successfully!');
    // }
}
