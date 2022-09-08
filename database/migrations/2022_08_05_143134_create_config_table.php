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
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('about');
            $table->boolean('show_about')->default(true);
            $table->boolean('show_gallery')->default(true);
            $table->boolean('show_videos')->default(true);
            $table->boolean('show_news')->default(true);
            $table->boolean('show_article')->default(true);
            $table->boolean('show_insta')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
};
