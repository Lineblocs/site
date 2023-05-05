<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            //
            $table->integer('billing_country_id')->nullable()->unsigned();
            $table->foreign('billing_country_id')->references('id')->on('billing_countries')->onDelete('SET NULL');
            $table->integer('billing_region_id')->nullable()->unsigned();
            $table->foreign('billing_region_id')->references('id')->on('billing_regions')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            //
        });
    }
}
