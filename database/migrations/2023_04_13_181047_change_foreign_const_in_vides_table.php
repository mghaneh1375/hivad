<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('video', function (Blueprint $table) {
            $table->dropForeign(['cat_id']);
            $table->foreign('cat_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropForeign(['cat_id']);
            $table->foreign('cat_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video', function (Blueprint $table) {
            $table->dropForeign(['cat_id']);
        });
        
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropForeign(['cat_id']);
        });
    }
};
