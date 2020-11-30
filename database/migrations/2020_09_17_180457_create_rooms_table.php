<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_room_id')->unsigned(); 
            $table->integer('client_id')->nullable();
            $table->string('number');
            $table->string('number_certificate')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('price_air', 8, 2)->nullable();
            $table->enum('frozen',['Ventilador','Aire Acondicionado','Aire Acondicionado---Ventilador']);
            $table->string('number_facture')->nullable();
            $table->enum('state',['Disponible','Ocupada','Mantenimiento'])->nullable();
            $table->boolean('condition')->default(1);
            $table->timestamps();

            $table->foreign('type_room_id')->references('id')->on('type_rooms');
            // $table->foreign('client_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
