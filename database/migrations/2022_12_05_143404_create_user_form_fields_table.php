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
        Schema::create('user_form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('field_id');
            $table->unsignedInteger('user_form_id');
            $table->longText('answer');
            $table->unique(['field_id', 'user_form_id']);
            $table->index('field_id');
            $table->index('user_form_id');
            $table->foreign('field_id')->on('fields')->references('id');
            $table->foreign('user_form_id')->on('user_forms')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_form_fields');
    }
};
