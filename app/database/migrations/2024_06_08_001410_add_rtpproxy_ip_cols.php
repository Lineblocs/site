<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRtpproxyIpCols extends Migration
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
            $table->string('ip_address');
            $table->string('private_ip_address');
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
