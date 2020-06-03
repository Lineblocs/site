<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ByoDidAction extends Migration
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
            $table->string('did_action')->default('accept-call');
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
