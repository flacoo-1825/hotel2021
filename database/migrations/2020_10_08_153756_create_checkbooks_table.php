<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('taxe_id')->unsigned()->nullable();
            $table->string('number_checkbooks');
            $table->string('faker_number_checkbooks');
            $table->date('date_entry_checkbooks')->nullable();
            $table->date('date_exit_checkbooks')->nullable();
            $table->enum('dian_checkbooks',['yes','no']);
            $table->double('total_checkbooks', 8, 2)->nullable();
            $table->boolean('state_checkbooks')->default(1);

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('taxe_id')->references('id')->on('taxes');
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
        Schema::dropIfExists('checkbooks');
    }
}
