<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegAndCpsFieldsToSipProvidersHosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_providers_hosts', function (Blueprint $table) {
            //
            $table->boolean("register_enabled")->default(FALSE);
            $table->string("register_username")->default("");
            $table->string("register_password")->default("");

            $table->boolean("cps_enabled")->default(FALSE);
            $table->integer("cps_limit")->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_providers_hosts', function (Blueprint $table) {
            //
        });
    }
}
