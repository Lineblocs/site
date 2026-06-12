<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNewWorkspaceUserPerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            $table->boolean('manage_faxes')->default(0)->after('manage_recordings');
            $table->boolean('manage_files')->default(0)->after('manage_faxes');
            $table->boolean('manage_support')->default(0)->after('manage_users');
            $table->boolean('manage_geo_permissions')->default(0)->after('manage_extension_codes');
            $table->boolean('manage_extended_settings')->default(0)->after('manage_geo_permissions');
            $table->boolean('manage_workspace_options')->default(0)->after('manage_workspace');
            $table->boolean('create_port_request')->default(0)->after('manage_workspace');
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
            $table->dropColumn([
                'manage_faxes',
                'manage_files',
                'manage_support',
                'manage_geo_permissions',
                'manage_extended_settings',
                'manage_workspace_options',
                'create_port_request'
            ]);
        });
    }
}