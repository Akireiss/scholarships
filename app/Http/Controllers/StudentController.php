<?php

namespace App\Http\Controllers;

use App\Models\Student;



class StudentController extends Controller
{
    public $provinces, $selectedProvince, $municipalities, $selectedMunicipality, $barangays, $selectedBarangay;

    // View More
    public function viewMore(Student $student)
    {
        return view('admin.scholarship.actions.view_more', ['student' => $student]);
    }


    public function viewMoreStaff(Student $student)
    {
        return view('staff.scholarship.actions.view_more', ['student' => $student]);
    }
    public function viewMoreNLUC(Student $student)
    {
        return view('campus-NLUC.scholarship.actions.view_more', ['student' => $student]);
    }

    // Update

    public function editAdmin(Student $student)
    {

        return view('admin.scholarship.actions.edit', ['student' => $student]);
    }
    public function editNLUC(Student $student)
    {

        return view('campus-NLUC.scholarship.actions.edit', ['student' => $student]);
    }

}
