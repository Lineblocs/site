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
            $table->string('availability'); // READY_TO_USE, PROVISIONING, UNAVAILABLE, PENDING_IN_REVIEW, REVIEW_FAILED_REFUNDED
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
