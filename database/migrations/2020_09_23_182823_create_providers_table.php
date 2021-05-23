<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_provider');
            $table->string('nit_provider');
            $table->string('name_provider');
            $table->string('firstSurname_provider');
            $table->string('secondSurname_provider')->nullable();
            $table->string('address_provider')->nullable();
            $table->string('phone_provider');
            $table->string('email_provider')->nullable();
            $table->integer('condition_provider')->default(1);
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
        Schema::dropIfExists('providers');
    }
}
