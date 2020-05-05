<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_defaults', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('phone_type');
            $table->integer('slotID');
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('phones_groups')->onDelete('CASCADE');
            $table->string('category_name');
            $table->string('setting_name');
            $table->string('setting_description');
            $table->string('setting_variable_name');
            $table->string('setting_variable_type');
            $table->string('setting_option_1');
            $table->string('setting_option_1_name');
            $table->string('setting_option_2');
            $table->string('setting_option_2_name');
            $table->string('setting_option_3');
            $table->string('setting_option_3_name');
            $table->string('setting_option_4');
            $table->string('setting_option_4_name');
            $table->string('setting_option_5');
            $table->string('setting_option_5_name');
            $table->string('setting_option_6');
            $table->string('setting_option_6_name');
            $table->string('setting_option_7');
            $table->string('setting_option_7_name');
            $table->string('setting_option_8');
            $table->string('setting_option_8_name');
            $table->string('setting_option_9');
            $table->string('setting_option_9_name');
            $table->string('setting_option_10');
            $table->string('setting_option_10_name');
            $table->string('setting_option_11');
            $table->string('setting_option_11_name');
            $table->string('setting_option_12');
            $table->string('setting_option_12_name');
            $table->string('setting_option_13');
            $table->string('setting_option_13_name');
            $table->string('setting_option_14');
            $table->string('setting_option_14_name');
            $table->string('setting_option_15');
            $table->string('setting_option_15_name');
            $table->string('setting_option_16');
            $table->string('setting_option_16_name');
            $table->string('setting_option_17');
            $table->string('setting_option_17_name');
            $table->string('setting_option_18');
            $table->string('setting_option_18_name');
            $table->string('setting_option_19');
            $table->string('setting_option_19_name');
            $table->string('setting_option_20');
            $table->string('setting_option_20_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phones_defaults');
    }
}
