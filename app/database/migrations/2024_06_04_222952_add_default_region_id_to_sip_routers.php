<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultRegionIdToSipRouters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_routers', function (Blueprint $table) {
            //
            $table->integer('region_id')->nullable()->unsigned();
            $table->foreign('region_id')->references('id')->on('sip_pop_regions')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_routers', function (Blueprint $table) {
            //
        });
    }
}
