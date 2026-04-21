<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentGatewayIdToInvoices extends Migration
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
            $table->string('payment_gateway_id')->nullable();
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
            $table->dropColumn('payment_gateway_id');
        });
    }
}
