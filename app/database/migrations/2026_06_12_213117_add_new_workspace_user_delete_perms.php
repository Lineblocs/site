<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNewWorkspaceUserDeletePerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            $table->boolean('delete_extension')->default(0)->after('create_extension');
            $table->boolean('delete_did')->default(0)->after('create_did');
            $table->boolean('delete_flow')->default(0)->after('create_flow');
            $table->boolean('delete_function')->default(0)->after('create_function');
            $table->boolean('delete_phone')->default(0)->after('create_phone');
            $table->boolean('delete_phonegroup')->default(0)->after('create_phonegroup');
            $table->boolean('delete_phoneglobalsetting')->default(0)->after('create_phoneglobalsetting');
            $table->boolean('delete_phoneindividualsetting')->default(0)->after('create_phoneindividualsetting');
            $table->boolean('delete_byo_carrier')->default(0)->after('create_byo_carrier');
            $table->boolean('delete_byo_did_number')->default(0)->after('create_byo_did_number');
            $table->boolean('delete_trunk')->default(0)->after('create_trunk');
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
                'delete_extension',
                'delete_did',
                'delete_flow',
                'delete_function',
                'delete_phone',
                'delete_phonegroup',
                'delete_phoneglobalsetting',
                'delete_phoneindividualsetting',
                'delete_byo_carrier',
                'delete_byo_did_number',
                'delete_trunk'
            ]);
        });
    }
}