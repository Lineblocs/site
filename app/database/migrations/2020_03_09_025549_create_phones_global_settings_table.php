<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_global_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('phone_type');
            $table->integer('phone_group')->unsigned()->nullable();
            $table->foreign('phone_group')->references('id')->on('phones_groups')->onDelete('CASCADE');
            $table->string('setting_variable_name');
            $table->string('setting_option_1');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');

            $table->string('public_id')->unique();

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
