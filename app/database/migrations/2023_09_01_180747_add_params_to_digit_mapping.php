<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParamsToDigitMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_routers_digit_mappings', function (Blueprint $table) {
            //
            $table->string('dnis')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sip_routers_digit_mappings', function (Blueprint $table) {
            //
        });
    }
}
