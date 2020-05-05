<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageTriggerResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_triggers_results', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('usage_trigger_id')->unsigned();
            $table->foreign('usage_trigger_id')->references('id')->on('usage_triggers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usage_triggers_results');
    }
}
