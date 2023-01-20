<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomizationFieldsForPreferences extends Migration
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
            $table->string('payment_gateway')->default('stripe');
            $table->boolean('payment_gateway_enabled')->default(FALSE);
            $table->boolean('custom_code_containers_enabled')->default(FALSE);
            $table->string('mail_provider')->default('smtp-gateway'); // smtp-gateway, ses, mailgun, etc...
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
