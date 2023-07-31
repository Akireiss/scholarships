<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 10);
            $table->string('lastname');
            $table->string('firstname');
            $table->string('initial');
            $table->string('email');
            $table->string('sex');
            $table->string('status');
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->string('campus');
            $table->string('course');
            $table->integer('level');
            $table->string('father');
            $table->string('mother');
            $table->string('contact', 11);
            $table->string('student_type');
            $table->string('name_school')->nullable();
            $table->string('last_year')->nullable();
            $table->boolean('recipient');
            $table->string('grant')->nullable();
            $table->string('remarks');
            $table->timestamps();

            // Foreign key constraints
            // $table->foreign('campus_id')->references('id')->on('campuses');
            // $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('municipality_id')->references('id')->on('municipals');
            // $table->foreign('barangay_id')->references('id')->on('barangays');
            // $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
