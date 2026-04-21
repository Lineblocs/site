<?php
use App\Workspace;
use App\Subscription;
use App\ServicePlan;

$plan = "new_plan";
$workspace = Workspace::where('name', 'dynamocloud')->firstorFail();
$servicePlan = ServicePlan::where('key_name', $plan)->firstorFail();
$subscription = new Subscription();

$billingCycle = 'MONTHLY';
if (isset($data['billing_cycle']) && $data['billing_cycle'] === 'annual') {
    $billingCycle = 'YEARLY';
}


$now = new DateTime();
if ($billingCycle === 'YEARLY') {
    $periodEnd = (clone $now)->modify('first day of next year')->setTime(0,0,0);
} else {
    $periodEnd = (clone $now)->modify('first day of next month')->setTime(0,0,0);
}

Subscription::create([
    'workspace_id' => $workspace->id,
    'current_plan_id' => $servicePlan->id,
    'status' => 'ACTIVE',
    'billing_cycle' => $billingCycle,
    'current_period_end' => $periodEnd
]);