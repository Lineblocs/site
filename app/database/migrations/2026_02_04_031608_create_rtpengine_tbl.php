<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtpengineTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtpengine', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('socket')->default('');
            $table->integer('set_id');
            $table->float('cpu_pct', 2, 2)->default(0.0);
            $table->float('cpu_used', 8, 2)->default(0.0);
            $table->float('mem_pct', 2, 2)->default(0.0);
            $table->float('mem_used', 8, 2)->default(0.0);
            $table->integer('active')->default(1);
            $table->string('status')->default('unknown');
            $table->integer('priority')->default(0);
            $table->string('region')->default('');
            $table->boolean('on_same_network_as_router')->default(false);

            $table->integer('router_id')->nullable()->unsigned();
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
        Schema::drop('rtpengine');
    }
}
