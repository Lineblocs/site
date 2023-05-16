<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspaceRoutingAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_routing_acl', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('routing_acl_id')->nullable()->unsigned();
            $table->foreign('routing_acl_id')->references('id')->on('sip_routing_acl')->onDelete('CASCADE');
            $table->integer('workspace_id')->nullable()->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');

            $table->boolean('enabled')->default(TRUE);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspace_routing_acl');
    }
}
