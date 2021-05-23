<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_check')->unsigned()->nullable();
            $table->string('end_check')->default('-Fact');
            $table->integer('number_ticket')->unsigned()->nullable();
            $table->string('end_ticket')->default('Fact');
            $table->integer('number_certificate')->unsigned()->nullable();
            $table->string('end_certificate')->default('-Act');
            $table->integer('number_reception')->unsigned()->nullable();
            $table->string('end_reception')->default('-Recept');
            $table->integer('number_ext')->unsigned()->nullable();
            $table->string('end_ext')->default('-Fact/ext');
            $table->integer('number_buy')->unsigned()->nullable();
            $table->string('end_buy')->default('-Comp');
            $table->integer('number_box')->unsigned()->nullable();
            $table->string('end_box')->default('-Comp');
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
        Schema::dropIfExists('counters');
    }
}
