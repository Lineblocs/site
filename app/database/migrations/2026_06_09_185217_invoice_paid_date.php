<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoicePaidDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_invoices', function (Blueprint $table) {
            //
            $table->dateTime('paid_date')->nullable();
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
            $table->dropColumn('paid_date');
        });
    }
}
