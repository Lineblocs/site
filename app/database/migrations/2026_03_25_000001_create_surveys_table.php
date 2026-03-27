<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurveysTable extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workspace_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('rating')->nullable();
            $table->string('token', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}

