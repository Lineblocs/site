<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGracePeriodExtensionToWorkspaces extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('workspaces', 'grace_period_extension')) {
            Schema::table('workspaces', function (Blueprint $table) {
                $table->integer('grace_period_extension')->nullable()->after('active');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('workspaces', 'grace_period_extension')) {
            Schema::table('workspaces', function (Blueprint $table) {
                $table->dropColumn('grace_period_extension');
            });
        }
    }
}
