<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWsSupportOptions extends Migration
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
            $table->boolean('ws_support')->default(FALSE);
            $table->string('ws_port')->default("10061");
            $table->boolean('wss_support')->default(FALSE);
            $table->string('wss_port')->default("10062");

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
