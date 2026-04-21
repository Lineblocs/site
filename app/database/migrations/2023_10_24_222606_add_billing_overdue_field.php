<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillingOverdueField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
            $table->integer('grace_period_billing_days')->default(7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            //
        });
    }
}
