<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRateRefToRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_providers_rates', function (Blueprint $table) {
            //
            $table->integer('rate_ref_id')->unsigned();
            $table->foreign('rate_ref_id')->references('id')->on('call_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_providers_rates', function (Blueprint $table) {
            //
        });
    }
}
