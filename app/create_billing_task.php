<?php
use App\Workspace;
use App\Subscription;
use App\User;
use App\ServicePlan;
use App\Helpers\RabbitMQHelper;

$workspaceId = 481;
$workspace = Workspace::find($workspaceId);
$subscription = Subscription::where('workspace_id', $workspace->id)->first();
$user = User::find($workspace->creator_id);
$billingCycle = $subscription->billing_cycle;
$plan = ServicePlan::find($subscription->current_plan_id);
$nextBillingDate = (new DateTime('first day of next month'))->format('Y-m-d');

$amountToCharge = 1; // 1 dollar

printf('Amount to charge: %s, Plan key_name: %s', $amountToCharge, $plan->key_name);

RabbitMQHelper::dispatchImmediateBilling(
        $workspace,
        $subscription,
        $user,
        $plan,
        $billingCycle,
        $amountToCharge,
        $nextBillingDate
    );

