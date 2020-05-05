<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSysUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_status_updates', function (Blueprint $table) {
            //
            $table->string('status'); // UP, DOWN, IN-MAINTENANCE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_status_updates', function (Blueprint $table) {
            //
        });
    }
}
