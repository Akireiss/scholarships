<?php

namespace App\Http\Livewire;


use App\Models\AuditLog;
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
            $backupFileName = 'backup-' . date('Y-m-d-His') . '.sql';

            $command = sprintf(
                'mysqldump -u%s -p%s %s > %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                $databaseName,
                storage_path('app/backups/' . $backupFileName)
            );

            // Execute the mysqldump command
            exec($command);

            // Store the backup file in the storage/app/backup directory
            Storage::disk('local')->move('backups/' . $backupFileName, 'backups/' . $backupFileName);

                // Create an audit log entry
                $user = auth()->user(); // Assuming you have authentication in place
                AuditLog::create([
                    'user_id' => $user->id,
                    'action' => 'Backup the database',
                    'data' => json_encode(['backup_file'. $backupFileName]),
                ]);
            // Display a success message
            session()->flash('message', 'Database backup completed successfully!');

        } catch (\Exception $e) {
            // Display an error message if the backup fails
            session()->flash('message', 'Database backup failed: ' . $e->getMessage());
        }
    }


}
