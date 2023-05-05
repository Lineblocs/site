<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCentsIncludingTaxes extends Migration
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
            $table->float('cents_including_taxes');
            $table->json('tax_metadata');
            $table->float('cents_taxes');
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
