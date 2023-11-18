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

    }

    public function down()
    {
        Schema::dropIfExists('campuses');
    }
}
