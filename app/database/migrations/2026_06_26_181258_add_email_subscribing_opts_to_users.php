<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailSubscribingOptsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('email_mute_auditing')->default(TRUE);
            $table->boolean('email_mute_account_changes')->default(TRUE);
            $table->boolean('email_mute_workspace_changes')->default(TRUE);
            $table->boolean('email_mute_system_status_updates')->default(TRUE);
            $table->boolean('email_mute_debugger')->default(TRUE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('email_mute_auditing');
            $table->dropColumn('email_mute_account_changes');
            $table->dropColumn('email_mute_workspace_changes');
            $table->dropColumn('email_mute_system_status_updates');
            $table->dropColumn('email_mute_debugger');
        });
    }
}
