<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateByoCarriersIps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('byo_carriers_ips', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ip');
            $table->string('range');
            $table->integer('carrier_id')->unsigned();
            $table->foreign('carrier_id')->references('id')->on('byo_carriers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('byo_carriers_ips');
    }
}
