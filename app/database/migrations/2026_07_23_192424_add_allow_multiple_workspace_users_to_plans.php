<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowMultipleWorkspaceUsersToPlans extends Migration
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
            $table->boolean('allow_multiple_workspace_users')->default(true);
            $table->boolean('trial_ends_on_purchase')->default(true);
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
            $table->dropColumn('allow_multiple_workspace_users');
            $table->dropColumn('trial_ends_on_purchase');
        });
    }
}
