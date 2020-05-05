<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones_definitions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('manufacturer');
            $table->string('model');
            $table->string('data1');
            $table->string('data2');
            $table->integer('phone_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phones_definitions');
    }
}
