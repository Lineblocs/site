<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddByoRoles extends Migration
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
            $table->boolean('manage_byo_carriers')->default(FALSE);
            $table->boolean('create_byo_carrier')->default(FALSE);
            $table->boolean('manage_byo_did_numbers')->default(FALSE);
            $table->boolean('create_byo_did_number')->default(FALSE);

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
