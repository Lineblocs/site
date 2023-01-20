<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicroserviceApiKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microservice_api_keys', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->timestamps();
            $table->string('service_name')->default('');
            $table->string('token');
            $table->dateTime('rotated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('microservice_api_keys');
    }
}
