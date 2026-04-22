<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonToBlockedNumbers extends Migration
{
    public function up()
    {
        Schema::table('blocked_numbers', function (Blueprint $table) {
            $table->text('reason')->nullable()->after('number');
        });
    }

    public function down()
    {
        Schema::table('blocked_numbers', function (Blueprint $table) {
            $table->dropColumn('reason');
        });
    }
}
