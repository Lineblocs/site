<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfNumberToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->string('confirmation_number', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->dropColumn('confirmation_number');
        });
    }
}
