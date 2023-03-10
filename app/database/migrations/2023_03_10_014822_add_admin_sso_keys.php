<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminSsoKeys extends Migration
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
            $table->text('google_signin_developer_key')->default('');
            $table->text('google_signin_client_id')->default('');
            $table->text('google_signin_app_id')->default('');
            $table->text('msft_signin_client_id')->default('');
            $table->text('msft_signin_client_secret')->default('');
            $table->text('apple_signin_client_id')->default('');
            $table->text('apple_signin_client_secret')->default('');
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
