<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('worker_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('provider_id')->unsigned()->nullable();
            $table->integer('buy_id')->unsigned()->nullable();
            $table->integer('sale_id')->unsigned()->nullable();
            $table->integer('room_id')->unsigned()->nullable();
            $table->integer('certificate_id')->unsigned()->nullable();
            $table->integer('taxe_id')->unsigned()->nullable();
            $table->string('number_bill');
            $table->enum('class_bill',['Compra','Venta']);
            $table->string('faker_number_bill');
            $table->date('date_entry_bill')->nullable();
            $table->date('date_exit_bill')->nullable();
            $table->enum('dian_bill',['yes','no']);
            $table->double('total_bill', 8, 2)->nullable();
            $table->text('description_bill')->nullable();
            $table->boolean('state_bill')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('buy_id')->references('id')->on('buys');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('certificate_id')->references('id')->on('certificates');
            $table->foreign('taxe_id')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
