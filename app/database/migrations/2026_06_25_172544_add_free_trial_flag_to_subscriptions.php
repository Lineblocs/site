<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeTrialFlagToSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            //
            $table->boolean('is_free_trial_active')->default(false);
            $table->dateTime('free_trial_start_date')->nullable();
            $table->dateTime('free_trial_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('is_free_trial_active');
            $table->dropColumn('free_trial_start_date');
            $table->dropColumn('free_trial_end_date');
        });
    }
}
