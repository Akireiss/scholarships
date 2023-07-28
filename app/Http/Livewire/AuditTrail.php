<?php

namespace App\Http\Livewire;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuditTrail extends Component
{
    public $auditLogs;

    public function mount()
    {
        $this->loadAuditLogs();
    }

    public function loadAuditLogs()
    {
        // Fetch the audit logs from the audit_trail table
        $this->auditLogs = AuditLog::orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.audit-trail');
    }
}
