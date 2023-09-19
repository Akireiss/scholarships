<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;

class DbDump extends Command
{

    protected $signature = 'db:dump {--database= : The database connection to use}';
    protected $description = 'Create a database dump using mysqldump';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $database = $this->option('database') ?: 'scholarship'; // Specify the name of your database
        $backupPath = storage_path('app/' . $database);

        // Execute the mysqldump command
        exec("mysqldump --single-transaction --user=" . config("database.connections.{$database}.username") . " --password=" . config("database.connections.{$database}.password") . " " . config("database.connections.{$database}.database") . " > $backupPath");

        $this->info('Database backup created successfully.');
    }
}
