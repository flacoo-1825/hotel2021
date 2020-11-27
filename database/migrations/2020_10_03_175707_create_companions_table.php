<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('certificate_id')->unsigned()->nullable();
            $table->string('temperature_entry_acomp')->nullable();
            $table->string('temperature_exit_acomp')->nullable();
            $table->string('cedula_acomp');
            $table->string('name_acomp');
            $table->string('firstSurname_acomp');
            $table->string('secondSurname_acomp')->nullable();
            $table->date('birth_date_acomp')->nullable();
            $table->timestamps();

            $table->foreign('certificate_id')->references('id')->on('certificates');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companions');
    }
}
