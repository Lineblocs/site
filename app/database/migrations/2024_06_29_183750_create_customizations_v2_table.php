<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizationsV2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizations_kv_store', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('key');
            $table->string('value_type');
            $table->string('string_value');
            $table->integer('number_value');
            $table->boolean('boolean_value');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customizations_kv_store');
    }
}
