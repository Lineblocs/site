<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddXmlAttrsToPhoneDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phones_defaults', function (Blueprint $table) {
            //
            $table->text('xml_attrs')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phones_defaults', function (Blueprint $table) {
            //
        });
    }
}
