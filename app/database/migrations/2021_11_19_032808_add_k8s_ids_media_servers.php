<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddK8sIdsMediaServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_servers', function (Blueprint $table) {
            //
		$table->string("k8s_pod_id")->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_servers', function (Blueprint $table) {
            //
        });
    }
}
