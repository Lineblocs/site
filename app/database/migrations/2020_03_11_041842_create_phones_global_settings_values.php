<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesGlobalSettingsValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_global_settings_values', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('setting_variable_name');
            $table->string('setting_option_1');
            $table->integer('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('phones_global_settings')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phones_global_settings');
    }
}
