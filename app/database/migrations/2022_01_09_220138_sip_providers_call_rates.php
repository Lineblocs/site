<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SipProvidersCallRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_providers_call_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('dial_prefix')->string('');
            $table->string('type')->string('');
            $table->string('call_rate')->string('');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('sip_countries')->onDelete('CASCADE');
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
        Schema::drop('sip_providers_call_rates');
    }
}
