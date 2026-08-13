<?php
use App\Helpers\RabbitMQHelper;
use App\Workspace;
use App\Subscription;
use App\ServicePlan;
use App\User;
use Illuminate\Support\Facades\Log;

$workspaceId = 523;
$workspace = Workspace::find($workspaceId);
$user = User::find($workspace->creator_id);

$amountInDollars = 5.00;

try {
    $subscription = Subscription::where('workspace_id', $workspace->id)->first();
    $servicePlan = null;
    if ($subscription) {
        $servicePlan = ServicePlan::find($subscription->current_plan_id);
    }

    $billingCycle = null;
    if ($subscription) {
        $billingCycle = $subscription->billing_cycle;
    }

    RabbitMQHelper::dispatchImmediateBilling(
        $workspace,
        $subscription,
        $user,
        $servicePlan,
        $billingCycle,
        $amountInDollars,
        null,
        'RELOAD_CREDITS'
    );
    printf("Add Credits Billing Queued: Workspace %d, Amount: %.2f\n", $workspace->id, $amountInDollars);
} catch (Exception $ex) {

    printf("error while dispatching billing for add credits: %s\n", $ex->getMessage());
    printf("%s\n", $ex->getTraceAsString());
}