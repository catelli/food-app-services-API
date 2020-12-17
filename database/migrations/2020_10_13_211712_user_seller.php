<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_seller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seller_id');
            $table->string('email');
            $table->string('password');
            $table->timestamps();

            $table->foreign('seller_id')
                            ->references('id')
                            ->on('sellers')
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
        Schema::dropIfExists('user_seller');
    }
}
