<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWhatsappParams extends Migration
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
            $table->string('whatsapp_phone_number_id')->default('');
            $table->string('whatsapp_access_token')->default('');
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
