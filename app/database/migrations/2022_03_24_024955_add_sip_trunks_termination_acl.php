<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipTrunksTerminationAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_trunks_termination_acl', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('identifier');
            $table->string('cidr_addr');
            $table->integer('trunk_id')->nullable()->unsigned();
            $table->foreign('trunk_id')->references('id')->on('sip_trunks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sip_trunks_termination_acl');
    }
}
