<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationQuestionnaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_questionnaire', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("question");
            $table->string("type")->default("choice");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registration_questionnaire');
    }
}
