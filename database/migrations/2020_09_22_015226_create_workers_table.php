<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id')->unsigned();
            $table->string('cedula_worker');
            $table->string('name_worker');
            $table->string('firstSurname_worker');
            $table->string('secondSurname_worker')->nullable();
            $table->date('birth_date_worker')->nullable();
            $table->enum('gender_worker',['Femenino','Masculino','No especifica']);
            $table->integer('age_worker')->nullable();
            $table->enum('scholarship_worker',['Primaria','Secundaria','Técnico','Profesional','Otro'])->nullable();
            $table->integer('number_children_worker');
            $table->enum('state_worker',['Soltero(a)','Casado(a)','Union Libre','Viudo(a)'])->nullable();
            $table->string('phone_worker')->nullable();
            $table->string('address_worker')->nullable();
            $table->string('email_worker')->unique();
            $table->string('password_worker')->bcrypt()->nullable();
            $table->boolean('condition_worker')->default(1);
            $table->rememberToken();
            $table->timestamps();

            
            $table->foreign('link_id')->references('id')->on('links');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
