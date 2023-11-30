<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AuditLog;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Route;

class AddScholar extends Component
{
    public $scholarship_type_id;
    public $scholarship_name;
    public $status;
    public $search = '';
    public $perPage = 10;
    public $data = [];


    public function render()
    {
        if(Route::is('admin.settings.addScholar')) {
            $scholarships = ScholarshipName::orderBy('name', 'asc')
            ->get();
            return view('livewire.add-scholar', ['scholarships' => $scholarships]);
        }elseif(Route::is('scholar.government')){
            $scholarships = ScholarshipName::orderBy('name', 'asc')->where('scholarship_type', 0)
            ->get();
            return view('livewire.add-scholar', ['scholarships' => $scholarships]);
        }elseif(Route::is('scholar.private')){
            $scholarships = ScholarshipName::orderBy('name', 'asc')->where('scholarship_type', 1)
            ->get();
            return view('livewire.add-scholar', ['scholarships' => $scholarships]);
        }elseif(Route::is('scholar.govermentActive')){
            $scholarships = ScholarshipName::orderBy('name', 'asc')->where('status', 0)->where('scholarship_type', 0)
            ->get();
            return view('livewire.add-scholar', ['scholarships' => $scholarships]);
        }elseif(Route::is('scholar.privateActive')){
            $scholarships = ScholarshipName::orderBy('name', 'asc')->where('status', 0)->where('scholarship_type', 1)
            ->get();
            return view('livewire.add-scholar', ['scholarships' => $scholarships]);
        }

    }

    public function addScholarship()
    {
        $this->validate([
            'scholarship_type_id' => 'required|in:0,1',
            'scholarship_name' => 'required|string',
        ]);

        ScholarshipName::create([
            'scholarship_type' => $this->scholarship_type_id,
            'name' => $this->scholarship_name,
            'status' => 0,
        ]);

        // Set success message
        session()->flash('message', 'Scholarship added successfully!');

        // Create an audit log entry
        $user = auth()->user(); // Assuming you have authentication in place
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Create a new scholarship name',
            'data' => json_encode('Created ' . $this->scholarship_name . ' by ' . $user->name),
        ]);

        $this->resetForm();
        $this->emit('scholarshipAdded'); // Emit an event for updating the Livewire table component
    }

    private function resetForm()
    {
        $this->scholarship_type_id = null;
        $this->scholarship_name = null;
    }
}
