<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSystemUpdateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->boolean("automatic_module_updates")->default(FALSE);
            $table->boolean("automatic_security_updates")->default(FALSE);
            $table->string("maintenance_window_day")->default('sunday');
            $table->string("maintenance_window_time")->default('03:00–11:00 UTC');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
        });
    }
}
