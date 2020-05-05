<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtensionsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('extension_id')->unsigned();
            $table->foreign('extension_id')->references('id')->on('extensions')->onDelete('CASCADE');
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
        Schema::drop('extensions_tags');
    }
}
