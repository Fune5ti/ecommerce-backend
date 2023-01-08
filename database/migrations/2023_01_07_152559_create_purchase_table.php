<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_address');
            $table->string('client_city');
            $table->string('client_zip');
            $table->string('client_country');
            $table->string('client_cpf');
            $table->float('total_price');
            $table->float('total_price_wt_discount');
            $table->float('total_value_of_discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
};
