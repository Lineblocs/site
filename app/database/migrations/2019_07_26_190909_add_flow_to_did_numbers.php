<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlowToDidNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('did_numbers', function (Blueprint $table) {
            //
            $table->integer('flow_id')->nullable()->unsigned();
            $table->foreign('flow_id')->references('id')->on('flows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('did_numbers', function (Blueprint $table) {
            //
        });
    }
}
