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
        Schema::create('slide_bar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority');
            $table->string('image');
            $table->boolean('visibility')->default(true);
            $table->string('alt')->nullable();
            $table->string('header')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide_bar');
    }
};
