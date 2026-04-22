<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceIdToBillingTables extends Migration
{
    /**
     * Add workspace_id + FK only when the table does not already have the column.
     *
     * @param string $tableName
     * @return void
     */
    protected function addWorkspaceColumnIfMissing($tableName)
    {
        if (!Schema::hasColumn($tableName, 'workspace_id')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->integer('workspace_id')->unsigned()->nullable();
                $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
            });
        }
    }

    /**
     * Drop workspace_id + FK only when the table has the column.
     *
     * @param string $tableName
     * @return void
     */
    protected function dropWorkspaceColumnIfExists($tableName)
    {
        if (Schema::hasColumn($tableName, 'workspace_id')) {
            Schema::table($tableName, function (Blueprint $table) {
                // FK might already be missing in some environments, so ignore drop errors.
                try {
                    $table->dropForeign(['workspace_id']);
                } catch (\Exception $e) {
                }

                $table->dropColumn('workspace_id');
            });
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addWorkspaceColumnIfMissing('users_credits');
        $this->addWorkspaceColumnIfMissing('users_debits');
        $this->addWorkspaceColumnIfMissing('users_invoices');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropWorkspaceColumnIfExists('users_credits');
        $this->dropWorkspaceColumnIfExists('users_debits');

        // users_invoices.workspace_id is defined in an older migration (2020_07_12...),
        // so this rollback should not remove it.
    }
}
