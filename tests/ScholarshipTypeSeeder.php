<?php

namespace Database\Seeders;

use App\Models\ScholarshipType;
use Illuminate\Database\Seeder;

class ScholarshipTypeSeeder extends Seeder
{
    public function run()
    {
        ScholarshipType::create(['name' => 'Government']);
        ScholarshipType::create(['name' => 'Private']);
    }
}
