<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipNameTable extends Migration
{
    public function up()
    {
        Schema::create('scholarship_name', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('scholarship_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scholarship_name');
    }
};
