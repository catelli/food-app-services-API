<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->string('num_cc');                               //credit cart number
            $table->string('cc_expd');                              //credit card expiration date
            $table->string('scty_cd');                              //security code
            $table->string('n_cdh');                                //cardholder name
            $table->string('d_cdh');                                //cardholder document (cpf/cnpj) 
            $table->string('registration_date');
            $table->timestamps();

            $table->foreign('user_id')
                            ->references('id')
                            ->on('users')
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
        Schema::dropIfExists('payments');
    }
}
