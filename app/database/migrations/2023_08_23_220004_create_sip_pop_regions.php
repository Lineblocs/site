<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipPopRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_pop_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->boolean('active')->default(false);
            //$table->integer('country_id')->unsigned();
            //$table->foreign('country_id')->references('id')->on('sip_countries')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_pop_regions');
    }
}
