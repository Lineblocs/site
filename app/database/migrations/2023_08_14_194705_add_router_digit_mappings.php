<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRouterDigitMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_routers_digit_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ani')->default('');
            $table->integer('route1')->nullable()->unsigned();
            $table->foreign('route1')->references('id')->on('sip_providers')->onDelete('CASCADE');

            $table->integer('route2')->nullable()->unsigned();
            $table->foreign('route2')->references('id')->on('sip_providers')->onDelete('CASCADE');

            $table->integer('route3')->nullable()->unsigned();
            $table->foreign('route3')->references('id')->on('sip_providers')->onDelete('CASCADE');

            $table->integer('route4')->nullable()->unsigned();
            $table->foreign('route4')->references('id')->on('sip_providers')->onDelete('CASCADE');

            $table->integer('route5')->nullable()->unsigned();
            $table->foreign('route5')->references('id')->on('sip_providers')->onDelete('CASCADE');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_routers_digit_mappings');
    }
}
