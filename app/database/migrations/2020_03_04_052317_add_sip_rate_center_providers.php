<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipRateCenterProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_rate_centers_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('center_id')->unsigned();
            $table->foreign('center_id')->references('id')->on('sip_rate_centers')->onDelete('CASCADE');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('sip_providers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_rate_centers_providers');
    }
}
