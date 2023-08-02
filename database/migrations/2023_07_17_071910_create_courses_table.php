<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->foreignId('campus_id')->constrained('campuses');
            $table->string('course_name');
            $table->timestamps();
        });

// insert here

        $courses =
        [
            ['course_name' => 'Bachelor of Science in Information System', 'campus_id' => 1],
            ['course_name' => 'Bachelor of Science in Information Technology', 'campus_id' => 2],
            ['course_name' => 'Bachelor of Science in Fish', 'campus_id' => 3],
            ['course_name' => 'Bachelor of Science in ML', 'campus_id' => 4],
        ];

        DB::table('courses')->insert($courses);


// it ends here
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }

};
