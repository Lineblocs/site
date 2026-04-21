<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecaptchaCreds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_credentials', function (Blueprint $table) {
            //
            $table->string('recaptcha_sitekey')->default('');
            $table->string('recaptcha_privatekey')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_credentials', function (Blueprint $table) {
            //
        });
    }
}
