<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkspacesRoutingFlows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_routing_flows', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('origin_code')->default('');
            $table->string('dest_code')->default('');
            $table->integer('flow_id')->unsigned();
            $table->foreign('flow_id')->references('id')->on('router_flows')->onDelete('CASCADE');
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('sip_countries')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_routing_flows');
    }
}
