<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("subject")->default("");
            $table->string("comment")->default("");
            $table->string("priority")->default("");
            $table->string("zendesk_id")->default("");
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::drop('support_tickets');
    }
}
