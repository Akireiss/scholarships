<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\FundSource;
use App\Models\ScholarshipName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourcesController extends Controller
{
    public function editFunds(FundSource $source_id) {
        return view('admin.settings.actions.editFunds', compact('source_id'));
    }
    public function updateFunds(Request $request, FundSource $source_id)
    {
           // Validate the input data
    $request->validate([
        'source_name' => 'string',
        'status' => 'in:0,1',
    ]);
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
