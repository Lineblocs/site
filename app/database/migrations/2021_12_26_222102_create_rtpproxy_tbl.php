<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtpproxyTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtpproxy_sockets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('rtpproxy_sock')->default('');
            $table->integer('set_id');
            $table->float('cpu_pct', 2, 2)->default(0.0);
            $table->float('cpu_used', 8, 2)->default(0.0);
            $table->float('mem_pct', 2, 2)->default(0.0);
            $table->float('mem_used', 8, 2)->default(0.0);
            $table->integer('active')->default(1);
            $table->string('status')->default('unknown');
            $table->integer('priority')->default(0);
            $table->string('region')->default('');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rtpproxy_sockets');
    }
}
