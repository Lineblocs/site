<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipCountryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_countries', function (Blueprint $table) {
            //
            $table->string('country_code')->default('');
            $table->integer('flow_id')->unsigned()->nullable();
            $table->foreign('flow_id')->references('id')->on('router_flows')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_countries', function (Blueprint $table) {
            //
        });
    }
}
