<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_tariff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tariff_id')->unsigned();
            $table->integer('price_id')->unsigned();

            $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
            $table->foreign('price_id')->references('id')->on('tariff_prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_tariff');
    }
}
