<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;


use App\Models\FundSource;
use App\Models\ScholarshipName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourcesController extends Controller
{
    // admin
    public function editFunds(FundSource $source_id) {

        return view('admin.settings.actions.editFunds', compact('source_id'));
    }


    public function updateFunds(Request $request, FundSource $source_id) {


        // Update the source_name model with the new data
        $source_id->update([
            'source_name' => $request->input('source_name'),
            'status' => $request->input('status'),
        ]);

        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Update Fund Source',
            'data' => json_encode('Updated by '. $user->name),
        ]);

        return redirect()->back()->with('success','Updated successfully');
    }
// staff
// nluc
public function editFundsnluc(FundSource $source_id) {

    return view('campus-NLUC.settings.actions.editFunds', compact('source_id'));
}


public function updateFundsNluc(Request $request, FundSource $source_id) {


    // Update the source_name model with the new data
    $source_id->update([
        'source_name' => $request->input('source_name'),
        'status' => $request->input('status'),
    ]);

    $user = Auth::user();
    AuditLog::create([
        'user_id' => $user->id,
        'action' => 'Update Fund Source',
        'data' => json_encode('Updated by '. $user->name),
    ]);

    return redirect()->back()->with('success','Updated successfully');
}

}
