<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('type_frozen_day');
            $table->integer('quantity_day')->unsigned()->nullable();
            $table->integer('many_hours_day')->unsigned()->nullable();
            $table->text('description_day')->nullable();
            $table->double('price_hour', 8, 2)->nullable()->nullable();
            $table->double('price_day', 8, 2)->nullable();
            $table->string('number_bill_day');
            $table->date('date_day')->nullable();
            $table->double('total_day', 8, 1)->nullable();
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
        Schema::dropIfExists('days');
    }
}
