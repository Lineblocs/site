<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardIdToCredits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_credits', function (Blueprint $table) {
            //
            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('users_cards');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_credits', function (Blueprint $table) {
            //
        });
    }
}
