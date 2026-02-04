<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->integer('default_region')->nullable()->unsigned();
            $table->foreign('default_region')->references('id')->on('sip_pop_regions')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
        });
    }
}
