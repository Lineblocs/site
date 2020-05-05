<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences_members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('conference_id')->unsigned();
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('CASCADE');
            $table->integer('call_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('calls')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conferences_members');
    }
}
