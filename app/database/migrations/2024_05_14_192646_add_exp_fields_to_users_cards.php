<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpFieldsToUsersCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_cards', function (Blueprint $table) {
            //
            $table->integer('exp_month')->nullable();
            $table->integer('exp_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_cards', function (Blueprint $table) {
            //
        });
    }
}
