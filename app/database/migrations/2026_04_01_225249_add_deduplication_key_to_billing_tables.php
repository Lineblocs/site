<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeduplicationKeyToUsersDebits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_debits', function (Blueprint $table) {
            //
            $table->string('deduplication_key')->nullable();
            $table->index('deduplication_key');
        });
        Schema::table('users_credits', function (Blueprint $table) {
            $table->string('deduplication_key')->nullable();
            $table->index('deduplication_key');
        });

        Schema::table('users_invoices', function (Blueprint $table) {
            $table->string('deduplication_key')->nullable();
            $table->index('deduplication_key');
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
            $table->dropColumn('deduplication_key');
        });
        Schema::table('users_invoices', function (Blueprint $table) {
            $table->dropColumn('deduplication_key');
        });
        Schema::table('users_debits', function (Blueprint $table) {
            //
        });
    }
}
