<?php

namespace App\Observers;
use App\Models\AuditLog;
// use App\Models\Grantee;
use Illuminate\Support\Facades\Auth;

class AuditLogObserver
{
    public function created($model)
    {
        $this->logAction('created', $model);
    }

    public function updated($model)
    {
        $this->logAction('updated', $model);
    }

    public function deleted($model)
    {
        $this->logAction('deleted', $model);
    }

    private function logAction($action, $model)
    {
        $logData = '';

        switch ($action) {
            case 'created':
                $logData = 'Created a new ';
                break;

            case 'updated':
                $logData = 'Updated the ';
                break;

            case 'deleted':
                $logData = 'Deleted a ';
                break;

            default:
                break;
        }

        // Customize the content based on the model being logged
        if ($model instanceof \App\Models\ScholarshipName) {
            $logData .= 'Scholarship: ' . $model->name;
        } elseif ($model instanceof \App\Models\FundSource) {
            $logData .= 'Fund Source: ' . $model->source_name;
        } elseif ($model instanceof \App\Models\User) {
            $logData .= 'User: ' . $model->username;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'data' => $logData,
        ]);
    }
}
