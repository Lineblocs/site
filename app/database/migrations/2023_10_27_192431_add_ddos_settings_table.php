<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDdosSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddos_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean("priority_aware_packet_policing")->default(FALSE);
            $table->boolean("media_packet_policing")->default(FALSE);
            $table->boolean("media_address_learning")->default(FALSE);
            $table->boolean("application_level_cac")->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ddos_settings');
    }
}
