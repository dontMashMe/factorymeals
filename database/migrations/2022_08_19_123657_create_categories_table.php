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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('slug');
        });

        Schema::table('meals', function($table){
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::table('meals', function($table){
            $table->dropColumn('category_id');
        });    
    }
};
