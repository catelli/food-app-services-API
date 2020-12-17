<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('zip_code');
            $table->string('street');
            $table->string('district');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('state');
            $table->string('city');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
    
}
