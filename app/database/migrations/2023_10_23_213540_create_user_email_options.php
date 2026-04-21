<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEmailOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email_options', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('auditing')->default(TRUE);
            $table->boolean('account_changes')->default(TRUE);
            $table->boolean('workspace_changes')->default(TRUE);
            $table->boolean('system_status_updates')->default(TRUE);
            $table->boolean('debugger')->default(TRUE);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('workspaces_users')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_email_options');
    }
}
