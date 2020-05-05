<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
            $table->boolean('manage_calls');
            $table->boolean('manage_recordings');
            $table->boolean('manage_blocked_numbers');
            $table->boolean('manage_ip_whitelist');
            $table->boolean('manage_verified_caller_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
        });
    }
}
