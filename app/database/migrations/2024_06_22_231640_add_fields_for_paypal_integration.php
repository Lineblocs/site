<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForPaypalIntegration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('api_credentials', function (Blueprint $table) {
            //
            $table->string('paypal_api_mode', 24)->default('live');
            $table->string('paypal_live_client_id', 128);
            $table->string('paypal_live_client_secret', 128);
            $table->string('paypal_test_client_id', 128);
            $table->string('paypal_test_client_secret', 128);
        });
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->boolean('paypal_enabled')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
