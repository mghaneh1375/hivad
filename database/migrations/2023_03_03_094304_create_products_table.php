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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('digest')->nullable();
            $table->longText('description');
            $table->unsignedInteger('price');
            $table->string('image');
            $table->string('alt')->nullable();
            $table->string('file');
            $table->boolean('visibility')->default(true);
            $table->unsignedInteger('priority');
            $table->boolean('is_imp')->default(false);
            $table->string('keywords')->nullable();
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
        Schema::dropIfExists('products');
    }
};
