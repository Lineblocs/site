<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspaceEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces');
            //created, upgraded, cancelled
            $table->string('type')->default('');
            //type of workspace
            $table->string('plan_snapshot')->default('');
            $table->boolean('processed_by_billing')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_events');
    }
}
