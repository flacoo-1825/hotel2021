<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkbook_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('additional_id')->unsigned()->nullable();
            $table->integer('day_id')->unsigned()->nullable();
            $table->integer('taxe_id')->unsigned()->nullable();
            $table->string('number_bill_sales');
            $table->enum('dian_bill',['yes','no']);
            $table->integer('quantity_sales')->unsigned()->nullable();
            $table->text('description_sales')->nullable();
            $table->double('price_unit_sales', 8, 2)->nullable();
            $table->double('total_sales', 8, 2)->nullable();
            $table->boolean('state_bill')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('taxe_id')->references('id')->on('taxes');
            $table->foreign('checkbook_id')->references('id')->on('checkbooks');
            $table->foreign('additional_id')->references('id')->on('additionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
