<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicies', function (Blueprint $table) {
            $table->id();
            $table->string('name_servicie')->nullable();
            $table->text('description_servicie')->nullable();
            $table->double('price_servicie', 8, 2)->nullable();
            $table->boolean('condition_servicie')->default(1);
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
        Schema::dropIfExists('servicies');
    }
}
