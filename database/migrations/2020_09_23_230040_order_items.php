<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderItems extends Migration
{
    public function up()
    {

        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->double('partial_value', 10, 2);
            $table->double('unitary_value', 10, 2);
            $table->timestamps();

            $table->foreign('product_id')
                            ->references('id')
                            ->on('products')
                            ->onUpdate('cascade');

            $table->foreign('order_id')
                            ->references('id')
                            ->on('orders')
                            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
