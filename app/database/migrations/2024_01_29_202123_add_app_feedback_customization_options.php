<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppFeedbackCustomizationOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->boolean('allow_app_feedback')->default(TRUE);
            $table->string('feedback_platform')->default('trustpilot');
            $table->string('trustpilot_url')->default('');
            $table->string('g2_url')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
        });
    }
}
