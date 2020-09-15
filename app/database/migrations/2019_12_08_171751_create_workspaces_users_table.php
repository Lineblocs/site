<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');


            $table->boolean('manage_users');
            $table->boolean('manage_extensions');
            $table->boolean('create_extension');
            $table->boolean('manage_billing');
            $table->boolean('manage_workspace');
            $table->boolean('manage_dids');
            $table->boolean('create_did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_users');
    }
}
