<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipName;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function funds($scholarship) {
        $scholarships = ScholarshipName::findOrFail($scholarship);
        return view('admin.scholarship.funds', [
            'scholarships' =>  $scholarships,
        ]);
    }
    public function fundsStaff($scholarship) {
        $scholarships = ScholarshipName::findOrFail($scholarship);
        return view('staff.scholarship.funds', [
            'scholarships' =>  $scholarships,
        ]);
    }
    // public function fundsNLUC($scholarship) {
    //     $scholarships = ScholarshipName::findOrFail($scholarship);
    //     return view('campus-NLUC.scholarship.funds', [
    //         'scholarships' =>  $scholarships,
    //     ]);
    // }
}
