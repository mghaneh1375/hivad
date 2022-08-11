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
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('tags');
            $table->string('title');
            $table->string('file');
            $table->integer('price');
            $table->string('digest')->nullable();
            $table->string('alt_img')->nullable();
            $table->string('keywords')->nullable();
            $table->boolean('visibility');
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
        Schema::dropIfExists('article');
    }
};
