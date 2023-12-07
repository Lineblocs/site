<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZendeskFields extends Migration
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
            $table->string("zendesk_subdomain")->default("");
            $table->string("zendesk_username")->default("");
            $table->string("zendesk_token")->default("");
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
