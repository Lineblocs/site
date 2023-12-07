<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRouterDigitMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_routers_digit_mappings', function (Blueprint $table) {
            //
            $table->integer('router_id')->unsigned();
            $table->foreign('router_id')->references('id')->on('sip_routers')->onDelete('CASCADE');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_routers_digit_mappings', function (Blueprint $table) {
            //
        });
    }
}
