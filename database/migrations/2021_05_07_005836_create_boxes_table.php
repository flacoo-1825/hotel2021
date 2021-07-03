<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id')->unsigned();
            $table->string('number_box');
            $table->double('open_efecty_box', 8, 1)->nullable();
            $table->double('sale_room', 8, 1)->nullable();
            $table->double('sale_reception', 8, 1)->nullable();
            $table->double('efecty_box', 8, 1)->nullable();
            $table->double('efecty_soft_box', 8, 1)->nullable();
            $table->double('credit_box', 8, 1)->nullable();
            $table->double('download_box', 8, 1)->nullable();
            $table->double('buy_box', 8, 1)->nullable();
            $table->double('difference_box', 8, 1)->nullable();
            $table->enum('state_box',['open','closed','pause']);
            $table->text('description_box')->nullable();
            $table->boolean('condition_box')->default(1);
            $table->timestamps();


            $table->foreign('worker_id')->references('id')->on('workers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
