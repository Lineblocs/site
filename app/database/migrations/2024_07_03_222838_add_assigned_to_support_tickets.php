<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedToSupportTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            //
            $table->integer('assigned_to_id')->unsigned()->nullable();
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            //
        });
    }
}
