<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ilocosNorteId = DB::table('provinces')->where('name', 'Ilocos Norte')->value('id');
        $ilocosSurId = DB::table('provinces')->where('name', 'Ilocos Sur')->value('id');
        $laUnionId = DB::table('provinces')->where('name', 'La Union')->value('id');

        DB::table('municipals')->insert([
            ['name' => 'Laoag City', 'province_id' => $ilocosNorteId],
            ['name' => 'Pagudpud', 'province_id' => $ilocosNorteId],
            ['name' => 'Vigan City', 'province_id' => $ilocosSurId],
            ['name' => 'Santa Maria', 'province_id' => $ilocosSurId],
            ['name' => 'San Fernando City', 'province_id' => $laUnionId],
            ['name' => 'Bauang', 'province_id' => $laUnionId],
            // Add more municipals if needed
        ]);
    }
}
