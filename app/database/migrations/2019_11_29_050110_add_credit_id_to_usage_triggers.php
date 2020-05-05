<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditIdToUsageTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usage_triggers_results', function (Blueprint $table) {
            //
            $table->integer('credit_id')->unsigned();
            $table->foreign('credit_id')->references('id')->on('users_credits');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usage_triggers_results', function (Blueprint $table) {
            //
        });
    }
}
