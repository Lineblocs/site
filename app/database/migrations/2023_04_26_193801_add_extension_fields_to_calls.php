<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtensionFieldsToCalls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            //
            $table->integer('from_extension_id')->unsigned()->nullable();
            $table->foreign('from_extension_id')->references('id')->on('extensions')->onDelete('SET NULL');

            $table->integer('to_extension_id')->unsigned()->nullable();
            $table->foreign('to_extension_id')->references('id')->on('extensions')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            //
        });
    }
}
