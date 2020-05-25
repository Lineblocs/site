<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipProvidersWhitelistIps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_providers_whitelist_ips', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('sip_providers')->onDelete('CASCADE');
            $table->string('ip_address');
            $table->string('range');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_providers_whitelist_ips');
    }
}
