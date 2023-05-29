<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipRoutingAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_routing_acl', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('iso');
            $table->string('name');
            $table->string('risk_level');
            $table->boolean('enabled')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_routing_acl');
    }
}
