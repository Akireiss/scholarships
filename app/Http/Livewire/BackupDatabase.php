<?php

namespace App\Http\Livewire;


use App\Models\AuditLog;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BackupDatabase extends Component
{

    public function render()
    {
        return view('livewire.backup-database');
    }
        public function backupDatabase()
        {
            try {
                $databaseName = config('database.connections.mysql.database');
                $databaseUser = config('database.connections.mysql.username');
                $databasePassword = config('database.connections.mysql.password');
                $backupFileName = $databaseName .'.sql';

                // Use the mysqldump command to create a backup
                $command = "mysqldump --user=$databaseUser --password=$databasePassword --host=" . config('database.connections.mysql.host') . " $databaseName > " . storage_path("app/backups/$backupFileName");
                exec($command);

                // Create an audit log entry
                $user = auth()->user(); // Assuming you have authentication in place
                AuditLog::create([
                    'user_id' => $user->id,
                    'action' => 'Backup the database',
                    'data' => json_encode('Backup the database named' . $backupFileName),
                ]);

                // If the backup is successful, set a success message in the session
                session()->flash('message', 'Database backup completed successfully');
            } catch (\Exception $e) {
                // If an error occurs during the backup process, set an error message
                session()->flash('message', 'Database backup failed: ' . $e->getMessage());
            }
        }

}
