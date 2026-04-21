<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOneTimeLoginLinksTable extends Migration
{
    public function up()
    {
        Schema::create('one_time_login_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('workspace_id');
            $table->string('token_hash', 191)->unique();
            $table->dateTime('expires_at');
            $table->dateTime('used_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'workspace_id']);
            $table->index('expires_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('one_time_login_links');
    }
}

