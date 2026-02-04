<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebsocketGatewayEndpointToSip extends Migration
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
            $table->string('websocket_gateway')->default('');
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
            $table->dropColumn('websocket_gateway');
        });
    }
}
