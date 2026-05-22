<?php

namespace App\Helpers;

use App\Customizations;
use App\Workspace;
use App\WorkspaceSuspension;
use DateTime;
use Schema;

final class WorkspaceSuspensionHelper
{
    public static function getGlobalGracePeriod()
    {
        $customizations = Customizations::getRecord();
        if ($customizations && $customizations->grace_period_billing_days !== null) {
            return (int) $customizations->grace_period_billing_days;
        }

        return 7;
    }

    public static function getActiveSuspension($workspaceId)
    {
        if (!Schema::hasTable('workspace_suspensions')) {
            return null;
        }

        $query = WorkspaceSuspension::where('workspace_id', $workspaceId)
            ->where('status', true);

        return $query->orderBy('suspended_at', 'desc')->first();
    }

    public static function getGracePeriodExtension($workspaceId)
    {
        $suspension = self::getActiveSuspension($workspaceId);

        if ($suspension && $suspension->grace_period_extension !== null) {
            return (int) $suspension->grace_period_extension;
        }

        return null;
    }

    public static function getGracePeriodThresholdForWorkspace($workspaceId)
    {
        $extension = self::getGracePeriodExtension($workspaceId);
        if ($extension !== null) {
            return $extension;
        }

        return self::getGlobalGracePeriod();
    }

    public static function saveGracePeriodExtension(Workspace $workspace, $value)
    {
        if (!Schema::hasTable('workspace_suspensions')) {
            return null;
        }

        $extension = null;
        if ($value !== null && $value !== '') {
            $extension = (int) $value;
        }

        $suspension = self::getActiveSuspension($workspace->id);
        if (!$suspension) {
            return null;
        }

        $suspension->grace_period_extension = $extension;
        $suspension->save();

        return $suspension;
    }

    public static function suspendWorkspace(Workspace $workspace, $invoice = null, $daysPastDue = null, $threshold = null)
    {
        if (!Schema::hasTable('workspace_suspensions')) {
            return null;
        }

        $suspension = self::getActiveSuspension($workspace->id);
        if (!$suspension) {
            $suspension = new WorkspaceSuspension();
            $suspension->workspace_id = $workspace->id;
            $suspension->suspended_at = new DateTime();
            $suspension->reason = 'payment_past_due';
            $suspension->status = true;
        }

        if (!$suspension->suspended_at) {
            $suspension->suspended_at = new DateTime();
        }
        if (!$suspension->reason) {
            $suspension->reason = 'payment_past_due';
        }
        $suspension->status = true;

        $suspension->save();

        if ($workspace->active) {
            $workspace->active = false;
            $workspace->save();
        }

        return $suspension;
    }
}
