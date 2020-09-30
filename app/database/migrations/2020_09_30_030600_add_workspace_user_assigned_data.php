<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceUserAssignedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
            $table->integer('extension_id')->nullable()->unsigned();
            $table->foreign('extension_id')->references('id')->on('extensions')->onDelete('CASCADE');
            $table->integer('number_id')->nullable()->unsigned();
            $table->foreign('number_id')->references('id')->on('did_numbers')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
        });
    }
}
