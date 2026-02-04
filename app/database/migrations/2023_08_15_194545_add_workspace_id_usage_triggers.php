<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceIdUsageTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usage_triggers', function (Blueprint $table) {
            //
            $table->integer('workspace_id')->nullable()->unsigned();
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
        Schema::table('usage_triggers', function (Blueprint $table) {
            //
        });
    }
}
