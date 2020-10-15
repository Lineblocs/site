<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_invites', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('workspace_id')->nullable()->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->integer('workspace_user_id')->nullable()->unsigned();
            $table->foreign('workspace_user_id')->references('id')->on('workspaces_users')->onDelete('CASCADE');
            $table->dateTime('expires_on');
            $table->boolean('valid')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_invites');
    }
}
