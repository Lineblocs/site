<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('call_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('calls');
            $table->string('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('call_tags');
    }
}
