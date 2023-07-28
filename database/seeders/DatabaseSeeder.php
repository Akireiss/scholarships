<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // // Log in a user temporarily for seeding
        // Auth::loginUsingId(1);

        // Call ScholarshipTypeSeeder first
        $this->call(ScholarshipTypeSeeder::class);

        // Call ScholarshipNameSeeder next
        $this->call(ScholarshipNameSeeder::class);

        // Call FundSourceSeeder last
        $this->call(FundSourceSeeder::class);

        // // Log out the user after seeding
        // Auth::logout();
}
}
