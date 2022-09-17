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
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('tags')->nullable();
            $table->string('title');
            $table->string('digest');
            $table->string('alt')->nullable();
            $table->boolean('visibility')->default(true);
            $table->integer('priority');
            $table->string('keywords')->nullable();
            $table->boolean('is_imp')->default(false);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('news');
    }
};
