<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddK8sIdsSipRouters extends Migration
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
        Schema::table('sip_routers', function (Blueprint $table) {
            //
        });
    }
}
