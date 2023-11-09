<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Auth;


class ScholarController extends Controller
{
    public function view(ScholarshipName $scholar) {
        return view('admin.settings.actions.view', compact('scholar'));
    }

    // Edit
    public function edit(ScholarshipName $scholar) {
        return view('admin.settings.actions.edit', compact('scholar'));
    }



    public function update(Request $request, ScholarshipName $scholar)
{
    // Validate the input data
    $request->validate([
        'scholarship_type_id' => 'in:0,1',
        'scholarship_name' => 'string',
        'status' => 'in:0,1',
    ]);

    // Update the record in the database
    $scholar->update([
        'scholarship_type' => $request->input('scholarship_type_id'),
        'name' => $request->input('scholarship_name'),
        'status' => $request->input('status'),
    ]);

    $user = Auth::user();
    AuditLog::create([
        'user_id' => $user->id,
        'action' => 'Update scholarship',
        'data' => json_encode('Updated by '. $user->name),
    ]);

    // Redirect the user to a page (e.g., show or index)
    return redirect()->back()->with('success', 'Scholarship updated successfully');
}





}
