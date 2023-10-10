<?php

namespace Database\Seeders;

use App\Models\ScholarshipName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScholarshipNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScholarshipName::create(['name' => 'FREE HIGHER EDUCATION', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Tertiary Education Subsidy', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'TES-Tulong Dunong Program', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Department of Science and Technology Science Education Institute Undergraduate Scholarship', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Department of Agriculture Competitiveness Enhancement Fund-Grant-in-Aid in Higher Education Program', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'CHED Tulong Agri Program', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Department of Agriculture Agricultural Training Institute Educational Assistance for Youth in Agriculture', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Department of Health Midwifery Scholarship Program', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'NCIP SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'OWWA SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'GSIS SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'DSWD TDP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'Bureau of Fisheries and Aquatic Resources-Fisheries Scholarship Program', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'CHED SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'CONGRESIONAL SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'MUNICIPAL SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'PROVINCIAL GOVERNMENT SCHOLARSHIP', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'SCHOLARSHIP FROM FOUNDATION', 'scholarship_type' => 0]);
        ScholarshipName::create(['name' => 'PRIVATE SCHOLARSHIP', 'scholarship_type' => 1]);
        // Add more data as needed
    }
}
