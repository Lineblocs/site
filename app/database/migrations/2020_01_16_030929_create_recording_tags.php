<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('recording_id')->unsigned();
            $table->foreign('recording_id')->references('id')->on('recordings');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recording_tags');
    }
}
