<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberSvcConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_services_config', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('param');
            $table->string('value');
            $table->integer('number_service_id')->nullable()->unsigned();
            $table->foreign('number_service_id')->references('id')->on('number_services')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('number_services_config');
    }
}
