<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_bill')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('provider_id')->unsigned()->nullable();
            $table->integer('worker_id')->unsigned()->nullable();
            $table->integer('taxe_id')->unsigned()->nullable();
            $table->string('number_bill_buy');
            $table->enum('class_pay',['Contado','Crédito'])->nullable();
            $table->date('date_pay')->nullable();
            $table->enum('dian_bill',['yes','no']);
            $table->integer('quantity_buy')->unsigned()->nullable();
            $table->text('description_buy')->nullable();
            $table->double('price_unit_buy', 8, 2)->nullable();
            $table->double('total_buy', 8, 2)->nullable();
            $table->boolean('state_buy')->default(1);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::dropIfExists('buys');
    }
}
