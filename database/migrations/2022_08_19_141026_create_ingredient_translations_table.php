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
        Schema::create('ingredient_translations', function (Blueprint $table) {
            $table->bigIncrements('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
            $table->string('locale')->index();
            
            //ingredients
            $table->unsignedBigInteger('ingredient_id');
            $table->unique(['ingredient_id', 'locale']);
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

            // fields to translate
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_translations');
    }
};
