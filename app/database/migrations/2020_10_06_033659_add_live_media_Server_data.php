<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLiveMediaServerData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_servers', function (Blueprint $table) {
            //
            $table->integer("live_call_count")->default(0);
            $table->float("live_cpu_pct_used")->default(0);
            $table->string("live_status"); // UP, DOWN, SUSPECT
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_servers', function (Blueprint $table) {
            //
        });
    }
}
