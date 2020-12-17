<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Seller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_name');
            $table->string('image');
            $table->string('zip_code');
            $table->string('cnpj')->unique();
            $table->string('bank');
            $table->string('agency');
            $table->string('account')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('roles');
            $table->string('api_token', 80)
                        ->unique()
                        ->nullable()
                        ->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('sellers');
    }
}
