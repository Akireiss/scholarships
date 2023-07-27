<?php

namespace Database\Seeders;

use App\Models\ScholarshipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipTypeSeeder extends Seeder
{
    public function run()
    {
        ScholarshipType::create(['name' => 'Government']);
        ScholarshipType::create(['name' => 'Private']);
    }
}
