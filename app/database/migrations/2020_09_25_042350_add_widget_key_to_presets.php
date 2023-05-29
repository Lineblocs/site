<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWidgetKeyToPresets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flow_templates_presets', function (Blueprint $table) {
            //
            $table->string("widget");
            $table->string("widget_key");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flow_templates_presets', function (Blueprint $table) {
            //
        });
    }
}
