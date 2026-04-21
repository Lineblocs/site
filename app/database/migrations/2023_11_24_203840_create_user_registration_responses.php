<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegistrationResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_registration_question_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('question_id')->unsigned()->nullable();
            $table->foreign('question_id')->references('id')->on('registration_questionnaire')->onDelete('SET NULL');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->string("question")->default("");
            $table->string("response")->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_registration_question_responses');
    }
}
