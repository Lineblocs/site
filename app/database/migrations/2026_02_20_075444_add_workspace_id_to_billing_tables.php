<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceIdToBillingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_credits', function (Blueprint $table) {
            $table->integer('workspace_id')->unsigned()->nullable();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
        });
        Schema::table('users_debits', function (Blueprint $table) {
            $table->integer('workspace_id')->unsigned()->nullable();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
        });
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->integer('workspace_id')->unsigned()->nullable();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_credits', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });
        Schema::table('users_debits', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });
    }
}
