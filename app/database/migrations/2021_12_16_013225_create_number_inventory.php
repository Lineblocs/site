<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumberInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('number');
            $table->string('api_number');
            $table->string('country');
            $table->string('region');

            $table->string('status'); // available, disconnected, etc..
            $table->string('features');
            $table->integer('monthly_cost'); //cents
            $table->integer('setup_cost'); //cents
            $table->integer('type'); //local,toll-free,vanity
            $table->integer('reserved_by')->nullable()->unsigned();
            $table->foreign('reserved_by')->references('id')->on('workspaces')->onDelete('SET NULL');


            $table->integer('routed_server')->nullable()->unsigned();
            $table->foreign('routed_server')->references('id')->on('sip_routers')->onDelete('SET NULL');

            $table->integer('provider_id')->nullable()->unsigned();
            $table->foreign('provider_id')->references('id')->on('sip_providers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('number_inventory');
    }
}
