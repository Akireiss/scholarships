<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundSourcesTable extends Migration
{
    public function up()
    {
        Schema::create('fund_sources', function (Blueprint $table) {
            $table->increments('source_id'); // Set 'source_id' as the primary key
            $table->string('source_name');
            $table->unsignedInteger('scholarship_name_id');
            // Add any other columns you need for the 'fund_sources' table here
            $table->timestamps();

            $table->foreign('scholarship_name_id')->references('id')->on('scholarship_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fund_sources');
    }
};
