<?php

namespace App\Helpers;

use App\Customizations;
use App\Enums\WorkspaceSuspensionStatus;
use App\Workspace;
use App\WorkspaceSuspension;
use DateTime;
use Log;
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

        $suspensions = WorkspaceSuspension::where('workspace_id', $workspaceId)
            ->orderBy('suspended_at', 'desc')
            ->get();

        foreach ($suspensions as $suspension) {
            if (WorkspaceSuspensionStatus::isActive($suspension->status)) {
                return $suspension;
            }
        }

        return null;
    }

    public static function getGracePeriodExtension($workspaceId)
    {
        if (Schema::hasColumn('workspaces', 'grace_period_extension')) {
            $workspace = Workspace::find($workspaceId);
            if ($workspace && $workspace->grace_period_extension !== null) {
                return (int) $workspace->grace_period_extension;
            }
        }

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
        $extension = null;
        if ($value !== null && $value !== '') {
            $extension = (int) $value;
        }

        if (Schema::hasColumn('workspaces', 'grace_period_extension')) {
            $workspace->grace_period_extension = $extension;
            $workspace->save();
        }

        if ($extension !== null && !$workspace->active) {
            $workspace->active = true;
            $workspace->save();
        }

        if (!Schema::hasTable('workspace_suspensions')) {
            return $workspace;
        }

        $suspensions = WorkspaceSuspension::where('workspace_id', $workspace->id)->get();

        if ($suspensions->isEmpty()) {
            return $workspace;
        }

        foreach ($suspensions as $suspension) {
            $suspension->grace_period_extension = $extension;
            if ($extension !== null) {
                $suspension->status = WorkspaceSuspensionStatus::NOT_SUSPENDED;
            }
            $suspension->save();
        }

        return $suspensions->first();
    }

    public static function suspendWorkspace(Workspace $workspace, $invoice = null, $daysPastDue = null, $threshold = null)
    {
        if (!Schema::hasTable('workspace_suspensions')) {
            return null;
        }

        $suspension = self::getActiveSuspension($workspace->id);
        $isNewSuspension = false;
        if (!$suspension) {
            $suspension = new WorkspaceSuspension();
            $suspension->workspace_id = $workspace->id;
            $suspension->suspended_at = new DateTime();
            $suspension->reason = 'payment_past_due';
            $suspension->status = WorkspaceSuspensionStatus::REAL_SUSPENSION;
            $isNewSuspension = true;
        }

        if (!$suspension->suspended_at) {
            $suspension->suspended_at = new DateTime();
        }
        if (!$suspension->reason) {
            $suspension->reason = 'payment_past_due';
        }
        $suspension->status = WorkspaceSuspensionStatus::REAL_SUSPENSION;

        $suspension->save();

        if ($workspace->active) {
            $workspace->active = false;
            $workspace->save();
        }

        if ($isNewSuspension) {
            try {
                RabbitMQHelper::dispatchWorkspaceSuspended($workspace, $suspension);
            } catch (\Exception $e) {
                Log::error('Failed to publish workspace suspension event: ' . $e->getMessage(), [
                    'workspace_id' => $workspace->id,
                    'suspension_id' => $suspension->id
                ]);
            }
        }

        return $suspension;
    }
}
