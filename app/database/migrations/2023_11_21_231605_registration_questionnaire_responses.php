<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationQuestionnaireResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_questionnaire_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("text")->default("");
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('registration_questionnaire')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registration_questionnaire_responses');
    }
}
