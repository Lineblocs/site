<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoTopupFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            //
            $table->boolean('auto_topup_enabled')->default(FALSE);
            $table->integer('auto_topup_threshold')->default(0);
            $table->integer('auto_topup_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('auto_topup_enabled');
            $table->dropColumn('auto_topup_threshold');
            $table->dropColumn('auto_topup_amount');
        });
    }
}
