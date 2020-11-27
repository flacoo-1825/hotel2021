<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('color')->nullable();
            $table->string('textColor')->nullable();
            $table->string('borderColor')->nullable();
            $table->enum('condition_state',['Reserva-fija','Reserva-editable',''])->nullable()->default('');
            $table->enum('condition_reservation',['On','off',''])->nullable()->default('On');

            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
