<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces_roles', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->timestamps();

            $table->string('key')->default('VIEWER');
            $table->string('name')->default('Viewer');
        });
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
            $table->integer('assigned_role_id')->unsigned()->nullable();
            $table->foreign('assigned_role_id')->references('id')->on('workspaces_roles')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workspaces_roles');
        Schema::table('workspaces_users', function (Blueprint $table) {
            //
        });
    }
}
