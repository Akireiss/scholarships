<?php

namespace App\Http\Livewire;

use App\Models\AuditLog;
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
        $this->auditLogs = AuditLog::latest()->get();
    }

    public function render()
    {
        return view('livewire.audit-trail');
    }
}
