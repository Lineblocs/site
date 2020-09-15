<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebuggerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debugger_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('from');
            $table->string('to');
            $table->string('title');
            $table->string('report');
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');
            $table->integer('flow_id')->unsigned()->nullable();
            $table->foreign('flow_id')->references('id')->on('flows');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('debugger_logs');
    }
}
