<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class schoolyearController extends Controller
{
    public function yearAdmin()
    {
        return view('admin.settings.school-year');
    }
    public function saveYear(Request $request)
    {
        $request->validate([
            'year' => 'required|regex:/^\d{4}-\d{4}$/',
        ]);

        SchoolYear::create([
            'school_year' => $request->input('year'),
        ]);

        return redirect()->back()->with('success', 'School year added successfully!');
    }

}
