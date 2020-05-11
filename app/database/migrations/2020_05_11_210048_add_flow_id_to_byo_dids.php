<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlowIdToByoDids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('byo_did_numbers', function (Blueprint $table) {
            //
            $table->integer('flow_id')->nullable()->unsigned();
            $table->foreign('flow_id')->references('id')->on('flows')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('byo_did_numbers', function (Blueprint $table) {
            //
        });
    }
}
