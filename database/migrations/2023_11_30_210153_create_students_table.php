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
            $table->string('student_id');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('initial');
            $table->string('email');
            $table->string('sex');
            $table->string('status');
            $table->unsignedBigInteger('barangay');
            $table->unsignedBigInteger('municipal');
            $table->unsignedBigInteger('province');
            $table->unsignedBigInteger('campus');
            $table->string('course');
            $table->integer('level');
            $table->string('father');
            $table->string('mother');
            $table->string('contact', 11);
            $table->string('studentType');
            $table->string('nameSchool')->nullable();
            $table->string('lastYear')->nullable();
            $table->string('student_status')->comment('0: Active, 1: Inactive')->default(0);
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('campus')->references('id')->on('campuses');
            $table->foreign('barangay')->references('id')->on('barangays');
            $table->foreign('municipal')->references('id')->on('municipals');
            $table->foreign('province')->references('id')->on('provinces');
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
