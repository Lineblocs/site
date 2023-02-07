<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesSipWebhooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_sip_webhooks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->string('http_url')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_sip_webhooks');
    }
}
