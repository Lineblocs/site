<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuspensionInitiatedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces_suspensions', function (Blueprint $table) {
            //
            $table->dateTime('suspension_initiated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces_suspensions', function (Blueprint $table) {
            //
            $table->dropColumn('suspension_initiated_at');
        });
    }
}
