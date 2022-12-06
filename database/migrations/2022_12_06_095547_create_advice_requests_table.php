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
        Schema::create('user_advice_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->length(11);
            $table->boolean('seen')->default(false);
            $table->enum('status', ['pending', 'rejected', 'accepted']);
            $table->boolean('is_paid')->default(false);
            $table->unsignedInteger('people_work_time_id');
            $table->index('people_work_time_id');
            $table->foreign('people_work_time_id')->on('people_work_times')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_advice_requests');
    }
};
