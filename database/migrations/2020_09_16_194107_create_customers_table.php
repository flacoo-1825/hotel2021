<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula_client');
            $table->string('name_client');
            $table->string('firstSurname_client');
            $table->string('secondSurname_client')->nullable();
            $table->date('birth_date_client');
            $table->enum('gender_client',['Femenino','Masculino','No especifica']);
            $table->integer('age_client')->nullable();
            $table->string('address_client')->nullable();
            $table->string('city_client')->nullable();
            $table->string('nationality_client')->nullable();
            $table->enum('state_client',['Soltero(a)','Casado(a)','Union Libre','Viudo(a)']);
            $table->string('phone_client');
            $table->string('email_client')->unique();
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
        Schema::dropIfExists('customers');
    }
}
