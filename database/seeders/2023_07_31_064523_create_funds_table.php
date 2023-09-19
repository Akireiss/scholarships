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
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->unsignedInteger('source_id');
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('source_id')->references('source_id')->on('fund_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
