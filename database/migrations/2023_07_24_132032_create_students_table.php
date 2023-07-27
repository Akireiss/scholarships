<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id', 20)->primary();
            $table->string('lastname', 255);
            $table->string('firstname', 255);
            $table->string('initial', 10)->nullable();
            $table->string('province', 100);
            $table->string('municipal', 100);
            $table->string('barangay', 100);
            $table->enum('sex', ['male', 'female']);
            $table->enum('status', ['single', 'married']);
            $table->string('contact', 11);
            $table->string('email', 255)->nullable();
            $table->string('course_name'); // Course name instead of course_id
            $table->unsignedInteger('level');
            $table->enum('studentType', ['new', 'continuing', 'return']);
            $table->string('nameSchool')->nullable();
            $table->string('lastYear')->nullable();
            $table->string('grant', 255)->nullable();
            $table->string('scholarship_type')->nullable(); // Scholarship type instead of scholarship_id
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('fund_sources');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
