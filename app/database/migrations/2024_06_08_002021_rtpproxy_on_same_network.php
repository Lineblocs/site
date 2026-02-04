<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RtpproxyOnSameNetwork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rtpproxy_sockets', function (Blueprint $table) {
            //
            $table->boolean('on_same_network_as_router')->default(TRUE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rtpproxy_sockets', function (Blueprint $table) {
            //
        });
    }
}
