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
        Schema::table('article', function (Blueprint $table) {
            $table->unsignedInteger('price')->default(0)->change();
            $table->boolean('visibility')->default(false)->change();
            $table->unsignedInteger('priority');
            $table->unsignedInteger('seen')->default(0);
            $table->unsignedInteger('download')->default(0);
            $table->unsignedInteger('category_id');
            $table->index('category_id');
            $table->foreign('category_id')->on('category')->references('id')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
            $table->dropColumn('priority');
            $table->dropColumn('seen');
            $table->dropColumn('download');
        });
    }
};
