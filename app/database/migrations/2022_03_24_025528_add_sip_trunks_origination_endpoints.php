<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipTrunksOriginationEndpoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_trunks_origination_endpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->String('sip_uri');
            $table->integer('trunk_id')->nullable()->unsigned();
            $table->foreign('trunk_id')->references('id')->on('sip_trunks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_trunks_origination_endpoints');
    }
}
