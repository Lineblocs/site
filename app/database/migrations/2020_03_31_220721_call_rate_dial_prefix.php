<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallRateDialPrefix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_rates_dial_prefixes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
          $table->integer('call_rate_id')->unsigned();
            $table->foreign('call_rate_id')->references('id')->on('call_rates')->onDelete('CASCADE');
            $table->string('dial_prefix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('call_rates_dial_prefixes');
    }
}
