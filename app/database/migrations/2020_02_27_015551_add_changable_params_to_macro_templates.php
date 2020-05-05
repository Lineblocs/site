<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangableParamsToMacroTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('macro_templates', function (Blueprint $table) {
            //
            $table->text('changeable_params'); //JSON
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('macro_templates', function (Blueprint $table) {
            //
        });
    }
}
