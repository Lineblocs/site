<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDidNumberTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('did_numbers_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('number_id')->unsigned();
            $table->foreign('number_id')->references('id')->on('did_numbers')->onDelete('CASCADE');
            $table->string('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('did_numbers_tags');
    }
}
