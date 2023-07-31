<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming you have municipal_id foreign key in barangays table
        $laoagCityId = DB::table('municipals')->where('name', 'Laoag City')->value('id');
        $pagudpudId = DB::table('municipals')->where('name', 'Pagudpud')->value('id');
        $viganCityId = DB::table('municipals')->where('name', 'Vigan City')->value('id');
        $santaMariaId = DB::table('municipals')->where('name', 'Santa Maria')->value('id');
        $sanFernandoCityId = DB::table('municipals')->where('name', 'San Fernando City')->value('id');
        $bauangId = DB::table('municipals')->where('name', 'Bauang')->value('id');

        DB::table('barangays')->insert([
            ['name' => 'Barangay 1 (Barangay Uno)', 'municipal_id' => $laoagCityId],
            ['name' => 'Saud', 'municipal_id' => $pagudpudId],
            ['name' => 'Barangay 2 (Barangay II)', 'municipal_id' => $viganCityId],
            ['name' => 'San Gabriel', 'municipal_id' => $santaMariaId],
            ['name' => 'Pagdaraoan', 'municipal_id' => $sanFernandoCityId],
            ['name' => 'Paringao', 'municipal_id' => $bauangId],
            // Add more barangays if needed
        ]);
    }
}
