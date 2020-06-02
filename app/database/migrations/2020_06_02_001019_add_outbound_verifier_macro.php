<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOutboundVerifierMacro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            //
            $table->integer('outbound_macro_id')->unsigned()->nullable();
            $table->foreign('outbound_macro_id')->references('id')->on('macro_functions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces', function (Blueprint $table) {
            //
        });
    }
}
