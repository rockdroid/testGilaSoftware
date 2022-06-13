<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sku');
            $table->string('brand');
            $table->unsignedDecimal('cost');
            $table->unsignedDecimal('finalPrice');
            $table->unsignedInteger('size');
            $table->integer('product_type_id')->unsigned();
            $table->integer('product_characteristic_id')->unsigned();

            $table->foreign('product_type_id')
                ->references('id')
                ->on('product_type')
                ->onDelete('cascade'); 

            $table->foreign('product_characteristic_id')
                ->references('id')
                ->on('product_characteristic')
                ->onDelete('cascade'); 

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
