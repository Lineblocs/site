<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailabilityToDidNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('did_numbers', function (Blueprint $table) {
            //
            $table->string('availability'); // ready-to-use, pending-in-review, review-failed-refunded
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('did_numbers', function (Blueprint $table) {
            //
        });
    }
}
