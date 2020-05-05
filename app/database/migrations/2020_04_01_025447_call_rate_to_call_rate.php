<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallRateToCallRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_rates', function (Blueprint $table) {
            //
            $table->decimal('call_rate', 8, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_rates', function (Blueprint $table) {
            //
            $table->decimal('call_rate', 8, 8);
        });
    }
}
