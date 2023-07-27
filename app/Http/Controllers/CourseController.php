<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCoursesByCampus(Request $request, $campus)
    {
        $courses = Course::where('campus', $campus)->get();

        return response()->json($courses);
    }
}
