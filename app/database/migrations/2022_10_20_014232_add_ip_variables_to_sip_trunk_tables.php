<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpVariablesToSipTrunkTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_trunks_origination_endpoints', function (Blueprint $table) {
            //
            $table->string('ipv4')->default(NULL);
            $table->string('ipv6')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_trunks_origination_endpoints', function (Blueprint $table) {
            //
        });
    }
}
