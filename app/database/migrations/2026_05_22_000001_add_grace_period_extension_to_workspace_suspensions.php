<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGracePeriodExtensionToWorkspaceSuspensions extends Migration
{
    public function up()
    {
        if (Schema::hasTable('workspaces_suspensions')) {
            return;
        }

        Schema::create('workspaces_suspensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('workspace_id')->unsigned();
            $table->timestamp('suspended_at');
            $table->integer('grace_period_extension')->nullable();
            $table->string('reason');
            $table->string('status')->default('INITIATED');

            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->index(array('workspace_id', 'status'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('workspaces_suspensions');
    }
}
