<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCampusesTable extends Migration
{
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->bigIncrements('id')->collation('utf8mb4_unicode_ci');
            $table->string('campus_name');
            $table->string('campusDesc');
            $table->timestamps();
        });

        $campuses = [
            ['campus_name' => 'NLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University North La Union Campus'],
            ['campus_name' => 'MLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University Mid La Union Campus'],
            ['campus_name' => 'SLUC', 'campusDesc' => 'Don Mariano Marcos Memorial State  University South La Union Campus'],
            ['campus_name' => 'OUS', 'campusDesc' => 'Don Mariano Marcos Memorial State  University Open University System'],
        ];

        DB::table('campuses')->insert($campuses);
    }

    public function down()
    {
        Schema::dropIfExists('campuses');
    }
}
