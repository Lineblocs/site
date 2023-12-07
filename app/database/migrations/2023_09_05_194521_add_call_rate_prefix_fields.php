<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCallRatePrefixFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_rates_dial_prefixes', function (Blueprint $table) {
            //
            $table->float('rate', 8, 4)->default(0.0);
            $table->string('destination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_rates_dial_prefixes', function (Blueprint $table) {
            //
        });
    }
}
