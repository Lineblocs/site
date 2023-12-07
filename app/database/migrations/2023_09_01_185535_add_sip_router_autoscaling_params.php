<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSipRouterAutoscalingParams extends Migration
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
            $table->boolean('udp_autoscaling')->default(FALSE);
            $table->integer('udp_min_workers')->default(4);
            $table->integer('udp_max_workers')->default(16);
            $table->boolean('tcp_autoscaling')->default(FALSE);
            $table->integer('tcp_min_workers')->default(4);
            $table->integer('tcp_max_workers')->default(16);
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
