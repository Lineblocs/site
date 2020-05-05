<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesIndividualSettingsValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_individual_settings_values', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('phones_individual_settings')->onDelete('CASCADE');


            $table->string('setting_variable_name');
            $table->string('setting_option_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phones_individual_settings_values');
    }
}
