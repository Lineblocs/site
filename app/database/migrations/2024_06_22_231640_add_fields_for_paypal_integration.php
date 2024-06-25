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
        Schema::create('api_credentials_group2', function (Blueprint $table) {
            //
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamps();

            $table->string('paypal_api_mode', 24)->default('live');
            $table->string('paypal_live_client_id', 128);
            $table->string('paypal_live_client_secret', 128);
            $table->string('paypal_test_client_id', 128);
            $table->string('paypal_test_client_secret', 128);
        });
        Schema::create('customizations_group2', function (Blueprint $table) {
            //
            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->increments('id')->unsigned();

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
