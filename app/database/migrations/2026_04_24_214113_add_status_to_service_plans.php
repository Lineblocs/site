<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToServicePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_plans', function (Blueprint $table) {
            //
            $table->string('status')->default('ACTIVE'); // ACTIVE, DISCONTINUED, ARCHIVED
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_plans', function (Blueprint $table) {
            //
        });
    }
}
