<?php

namespace App\Http\Controllers;

use App\Models\FundSource;
use App\Models\ScholarshipName;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function editFunds(FundSource $source_id) {
        // $source_id = FundSource::findOrfail($source_id)->where->();
        return view('admin.settings.actions.editFunds', compact('source_id'));
    }

    public function updateFunds(Request $request, FundSource $source_id) {

        // Add this for debugging

        // Update the source_name model with the new data
        $source_id->update([
            'source_name' => $request->input('source_name'),
            'status' => $request->input('status'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Source funds updated successfully');
    }


}
