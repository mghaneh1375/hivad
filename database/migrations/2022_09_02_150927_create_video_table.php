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
        Schema::create('video', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('file');
            $table->string('alt')->nullable();
            $table->unsignedInteger('cat_id');
            $table->string('tags')->nullable();
            $table->string('title')->nullable();
            $table->boolean('visibility')->default(true);
            $table->boolean('is_imp')->default(false);
            $table->integer('priority');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('category')->onUpdate('restrict')->onDelete('restrict');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
};
