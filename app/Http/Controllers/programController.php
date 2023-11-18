<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Course;
use Illuminate\Http\Request;

class programController extends Controller
{
    public $campuses;

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
}
