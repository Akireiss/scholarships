<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call ScholarshipTypeSeeder first
        $this->call(ScholarshipTypeSeeder::class);

        // Call ScholarshipNameSeeder next
        $this->call(ScholarshipNameSeeder::class);

        // Call FundSourceSeeder last
        $this->call(FundSourceSeeder::class);
    }
}
