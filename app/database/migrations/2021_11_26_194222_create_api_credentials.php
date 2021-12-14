<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiCredentials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('aws_access_key_id')->default('');
            $table->string('aws_secret_access_key')->default('');
            $table->string('aws_region')->default('us-east-1');
            $table->string('stripe_pub_key')->default('');
            $table->string('stripe_private_key')->default('');
            $table->string('stripe_test_pub_key')->default('');
            $table->string('stripe_test_private_key')->default('');
            $table->string('stripe_mode')->default('');
            $table->string('smtp_host')->default('');
            $table->string('smtp_port')->default('');
            $table->string('smtp_user')->default('');
            $table->string('smtp_password')->default('');
            $table->boolean('smtp_tls')->default(FALSE);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('api_credentials')->default('');
    }
}
