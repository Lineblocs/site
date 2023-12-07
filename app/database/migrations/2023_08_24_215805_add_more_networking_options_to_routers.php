<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreNetworkingOptionsToRouters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_routers', function (Blueprint $table) {
            //
            $table->boolean('udp_support')->default(TRUE);
            $table->string('udp_port')->default("5060");
            $table->boolean('tcp_support')->default(FALSE);
            $table->string('tcp_port')->default("5080");
            $table->boolean('tls_support')->default(FALSE);
            $table->string('tls_port')->default("5061");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_routers', function (Blueprint $table) {
            //
        });
    }
}
