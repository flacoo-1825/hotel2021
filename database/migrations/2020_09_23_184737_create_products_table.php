<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->string('name_product');
            $table->string('img_product')->nullable();
            $table->integer('stock_product')->nullable();
            $table->string('start_product')->nullable();
            $table->double('buy_product', 8, 2)->nullable();
            $table->double('sale_product', 8, 2)->nullable();
            $table->boolean('condition_product')->default(1);

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
