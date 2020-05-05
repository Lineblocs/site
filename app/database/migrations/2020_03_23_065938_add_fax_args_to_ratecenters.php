<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFaxArgsToRatecenters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sip_rate_centers', function (Blueprint $table) {
            //
            $table->boolean('fax_enabled')->default(FALSE);
            $table->string('fax_data_1');
            $table->string('fax_data_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rate_centers', function (Blueprint $table) {
            //
        });
    }
}
