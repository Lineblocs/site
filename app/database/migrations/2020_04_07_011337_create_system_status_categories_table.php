<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemStatusCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_status_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name'); // DID API availability, partner SIP trunking networks, media storage uptime, PoP uptime
            $table->string('status'); // UP, DOWN, IN-MAINTENANCE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_status_categories');
    }
}
