<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_work_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('people_id');
            $table->unsignedInteger('schedule_id');
            $table->unsignedInteger('priority');
            $table->string('start')->length(5);
            $table->string('end')->length(5);
            $table->index('people_id');
            $table->index('schedule_id');
            $table->foreign('schedule_id')->on('schedules')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('people_id')->on('people')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_work_times');
    }
};
