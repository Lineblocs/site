<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatePresets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_templates_presets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('flows_templates')->onDelete('CASCADE');
            $table->string('var_name');
            $table->string('screen_name');
            $table->string('description');
            $table->string('variable_type'); // basic, workspace_lookup
            $table->string('data_type'); // text, select
            $table->text('extras'); // JSON of extras in case of select
            $table->string('lookup_table'); // valid table
            $table->string('lookup_key'); 
            $table->string('depends_on_field');
            $table->string('depends_on_value');
            $table->string('default');
            $table->string('placeholder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flow_templates_presets');
    }
}
