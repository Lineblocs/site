<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrefixPriorityToSipHosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_providers_hosts', function (Blueprint $table) {
            //
            $table->string('priority_prefixes'); // comma separated
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_providers_hosts', function (Blueprint $table) {
            //
        });
    }
}
