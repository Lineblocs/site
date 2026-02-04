<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToQuestionnaireResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_questionnaire_responses', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('workspace_id')->unsigned();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('CASCADE');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_questionnaire_responses', function (Blueprint $table) {
            //
        });
    }
}
