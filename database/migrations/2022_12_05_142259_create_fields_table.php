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
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('for', ['survey', 'advice'])->default('survey');
            $table->string('label');
            $table->longText('options')->nullable();
            $table->unsignedInteger('priority');
            $table->boolean('is_required')->default(true);
            $table->boolean('visibility')->default(true);
            $table->enum('type', ['number', 'textarea', 'radio', 'checkbox', 'text'])->default('text');
            $table->string('slug');
            $table->unique(['slug', 'for']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
