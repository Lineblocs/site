<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipRoutersMediaServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_routers_media_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('router_id')->unsigned()->nullable();
            $table->foreign('router_id')->references('id')->on('sip_routers')->onDelete('cascade');

            $table->integer('server_id')->unsigned()->nullable();
            $table->foreign('server_id')->references('id')->on('media_servers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_routers_media_servers');
    }
}
