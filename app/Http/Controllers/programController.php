<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Course;
use Illuminate\Http\Request;

class programController extends Controller
{
    public $campuses;
    public $nlucCampuses;
// admin
    public function adminProgram()
    {
        $campuses = Campus::all();

        return view('admin.settings.program', [
            'campuses' => $campuses,
        ]);
    }

    public function saveCampus(Request $request)
    {
        // Validation logic here if needed

        $campus = new Campus();
        $campus->campus_name = $request->input('campus');
        $campus->campusDesc = $request->input('campus_description');
        $campus->save();

        return redirect()->back()->with('success', 'Campus saved successfully');
    }
    public function saveCourse(Request $request)
    {
        // Validation logic here if needed

        $course = new Course();
        $course->campus_id = $request->input('campus_select');
        $course->course_name = $request->input('course_program');
        $course->save();

        return redirect()->back()->with('success', 'Course saved successfully');
    }

    // staff


    // campusNLUC
    public function nlucProgram()
    {
        $nlucCampuses = Campus::where('campus_name', 'NLUC' )->get();

        return view('campus-NLUC.settings.program', [
            'nlucCampuses' => $nlucCampuses,
        ]);
    }
    public function nlucsaveCourse(Request $request)
    {
        $request->validate([
            'campus_select' => 'required',
            'course_program' => 'required',
        ]);

        $course = new Course();
        $course->campus_id = $request->input('campus_select');
        $course->course_name = $request->input('course_program');
        $course->save();

        return redirect()->back()->with('success', 'Course saved successfully');
    }


}
