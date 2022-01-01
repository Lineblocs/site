<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceToRouterFlows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('router_flows', function (Blueprint $table) {
            //
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('router_flows', function (Blueprint $table) {
            //
        });
    }
}
