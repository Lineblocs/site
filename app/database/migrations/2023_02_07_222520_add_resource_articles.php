<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('seo_tags');
            $table->text('content');
            $table->integer('section_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('resource_articles_sections')->onDelete('CASCADE');
            $table->boolean('active')->default(FALSE);
            $table->boolean('featured')->default(FALSE);
            $table->boolean('important')->default(FALSE);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('hits')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resource_articles');
    }
}
