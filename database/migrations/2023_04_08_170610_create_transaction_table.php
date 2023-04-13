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
        Schema::create('transactions', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('tracking_code');
            $table->unsignedInteger('off')->nullable();
            $table->string('additional_id');

            $table->enum('status', ['init', 'cancelled', 'complete'])->default('init');
            $table->string('ref_num')->nullable();

            $table->index('user_id');
            $table->index('product_id');

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')->on('products')->references('id');
                
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
        Schema::dropIfExists('transactions');
    }
};
