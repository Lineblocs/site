<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceArticleSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_articles_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('key_name')->default('');
            $table->string('name')->default('');
            $table->string('link')->default('');
            $table->string('description')->default('');
            $table->string('image_icon')->default('');
            $table->string('size')->default('full'); // translate to 's12 l6' for bootstrap framework
            $table->boolean('show_desc')->default(FALSE);
            $table->boolean('active')->default(FALSE);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resource_articles_sections');
    }
}
