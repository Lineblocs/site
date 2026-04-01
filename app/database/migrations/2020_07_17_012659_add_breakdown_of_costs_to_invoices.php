<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBreakdownOfCostsToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->integer('call_costs')->default(0);
            $table->integer('recording_costs')->default(0);
            $table->integer('fax_costs')->default(0);
            $table->integer('membership_costs')->default(0);
            $table->integer('number_costs')->default(0);
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
            //
        });
    }
}
