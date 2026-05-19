<?php

namespace App\Helpers;

use Config;
use DateTime;
use DateTimeZone;
use Mail;
use App\User;
use App\Workspace;
use App\ServicePlan;
use App\Subscription;
use App\BillingTax;
use App\UserDebit;
use App\UserInvoice;
use App\UserInvoiceLineItem;
use App\WorkspaceUser;
use App\CustomizationsKVStore;
use App\Enums\InvoiceSource;
use App\Enums\PaymentStatus;

final class WorkspaceInvoiceHelper
{
    public static function sendInvoiceForWorkspace(Workspace $workspace, $period, User $owner = null, $invoiceId = null)
    {
        $period = strtoupper($period);
        if ($period !== 'MONTHLY' && $period !== 'ANNUAL') {
            throw new \Exception('Invalid invoice period. Use MONTHLY or ANNUAL.');
        }

        if (!$owner) {
            $owner = $workspace->creatorUser;
        }
        if (!$owner || empty($owner->email)) {
            throw new \Exception(sprintf('Owner email missing for workspace #%d.', $workspace->id));
        }

        self::normalizeWorkspacePlan($workspace);

        if (empty($invoiceId)) {
            $invoiceData = self::createInvoice($owner, $workspace, $period);
        } else {
            $invoiceData = self::getInvoiceData($owner, $workspace, $invoiceId);
        }

        $invoice = $invoiceData['invoice'];
        $pdf = InvoiceHelper::generatePrettyInvoice($owner, $workspace, $invoice)->output();

        $taskPayload = self::buildInvoiceTaskPayload($owner, $workspace, $period, $invoiceData);

        if ($period === 'ANNUAL') {
            $subjectPrefix = 'annual';
        } else {
            $subjectPrefix = 'monthly';
        }
        $subject = sprintf('%s %s invoice', MainHelper::getSiteName(), $subjectPrefix);
        $mailConfig = Config::get('mail');
        $siteName = MainHelper::getSiteName();
        $customizations = CustomizationsKVStore::getRecord();
        if ($period === 'ANNUAL') {
            $filePrefix = 'annual';
        } else {
            $filePrefix = 'monthly';
        }

        Mail::send('emails.workspace_invoices', [
            'user' => $owner,
            'workspace' => $workspace,
            'site' => $siteName,
            'site_name' => $siteName,
            'customizations' => $customizations,
            'period' => $period
        ], function ($message) use ($owner, $mailConfig, $subject, $pdf, $invoice, $filePrefix) {
            $message->to($owner->email);
            $message->subject($subject);
            $from = $mailConfig['from'];
            $message->from($from['address'], $from['name']);
            $message->attachData($pdf, sprintf('%s_invoice_%s.pdf', $filePrefix, $invoice->invoice_no), [
                'mime' => 'application/pdf'
            ]);
        });

        return [
            'workspace_id' => $workspace->id,
            'email' => $owner->email,
            'invoice_no' => $invoice->invoice_no,
            'period' => $period,
            'queue_task' => $taskPayload
        ];
    }

    private static function normalizeWorkspacePlan(Workspace $workspace)
    {
        //$plan = ServicePlan::where('key_name', $workspace->plan)->first();
        //$plan = ServicePlan::where('workspace_id', $workspace->id)->firstOrFail();
        $plan = Subscription::select(array('service_plans.*'))
            ->join('service_plans', 'subscriptions.current_plan_id', '=', 'service_plans.id')
            ->where('subscriptions.workspace_id', $workspace->id)
            ->firstOrFail();
        $workspace->plan = $plan->key_name;
    }

    private static function resolvePrimaryTax(Workspace $workspace)
    {
        if (!empty($workspace->billing_region_id)) {
            $tax = BillingTax::where('region_id', $workspace->billing_region_id)
                ->where('primary_tax', '1')
                ->first();
            if ($tax) {
                return $tax;
            }
        }

        $tax = BillingTax::where('primary_tax', '1')->first();
        if ($tax) {
            return $tax;
        }

        return BillingTax::first();
    }

    private static function getInvoiceRange($period)
    {
        if ($period === 'ANNUAL') {
            $rangeStart = (new DateTime())->modify('first day of january this year')->setTime(0, 0, 0);
            $dueDate = (new DateTime())->modify('last day of december this year')->setTime(23, 59, 59);
            $invoicePrefix = 'A';
        } else {
            $rangeStart = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
            $dueDate = (new DateTime())->modify('last day of this month')->setTime(23, 59, 59);
            $invoicePrefix = 'M';
        }

        return [
            'start' => $rangeStart,
            'end' => $dueDate,
            'prefix' => $invoicePrefix
        ];
    }

    private static function sumDebitsForSources(Workspace $workspace, DateTime $rangeStart, DateTime $rangeEnd, array $sources)
    {
        return (int) UserDebit::where('workspace_id', $workspace->id)
            ->whereIn('source', $sources)
            ->whereBetween('created_at', [$rangeStart->format('Y-m-d H:i:s'), $rangeEnd->format('Y-m-d H:i:s')])
            ->sum('cents');
    }

    private static function calculateMembershipCosts(Workspace $workspace, $period, DateTime $rangeStart, DateTime $rangeEnd)
    {
        $subscription = Subscription::where('workspace_id', $workspace->id)->first();
        if (!$subscription) {
            return 0;
        }

        $plan = ServicePlan::find($subscription->current_plan_id);
        if (!$plan) {
            return 0;
        }

        if ($plan->pay_as_you_go) {
            return 0;
        }

        $userCount = WorkspaceUser::where('workspace_id', $workspace->id)
            ->where(function ($query) use ($rangeStart, $rangeEnd) {
                $query->where('status', 'ACTIVE')
                    ->orWhere(function ($subQuery) use ($rangeStart, $rangeEnd) {
                        $subQuery->where('status', 'TERMINATED')
                            ->whereBetween('activated_account_at', [
                                $rangeStart->format('Y-m-d H:i:s'),
                                $rangeEnd->format('Y-m-d H:i:s')
                            ]);
                    });
            })
            ->count();

        $planCost = (int) $plan->monthly_cost_cents;
        if ($period === 'ANNUAL') {
            $planCost = (int) $plan->annual_cost_cents;
            if ($planCost <= 0) {
                $planCost = (int) $plan->monthly_cost_cents * 12;
            }
        }

        return $userCount * $planCost;
    }

    private static function aggregateInvoiceCosts(Workspace $workspace, $period, DateTime $rangeStart, DateTime $rangeEnd)
    {
        $callCosts = self::sumDebitsForSources($workspace, $rangeStart, $rangeEnd, ['CALL']);
        $recordingCosts = self::sumDebitsForSources($workspace, $rangeStart, $rangeEnd, ['RECORDING', 'API usage - RECORDING']);
        $faxCosts = self::sumDebitsForSources($workspace, $rangeStart, $rangeEnd, ['FAX', 'API usage - FAX']);
        $numberCosts = self::sumDebitsForSources($workspace, $rangeStart, $rangeEnd, ['NUMBER_RENTAL', 'DID_RENTAL']);
        $membershipCosts = self::calculateMembershipCosts($workspace, $period, $rangeStart, $rangeEnd);

        return [
            'call_costs' => $callCosts,
            'recording_costs' => $recordingCosts,
            'fax_costs' => $faxCosts,
            'membership_costs' => $membershipCosts,
            'number_costs' => $numberCosts
        ];
    }

    private static function createInvoice(User $owner, Workspace $workspace, $period)
    {
        $period = strtoupper($period);
        $now = new DateTime();
        $range = self::getInvoiceRange($period);
        $rangeStart = $range['start'];
        $dueDate = $range['end'];
        $invoicePrefix = $range['prefix'];

        $costs = self::aggregateInvoiceCosts($workspace, $period, $rangeStart, $dueDate);
        $callCosts = $costs['call_costs'];
        $recordingCosts = $costs['recording_costs'];
        $membershipCosts = $costs['membership_costs'];
        $faxCosts = $costs['fax_costs'];
        $numberCosts = $costs['number_costs'];
        $invoiceSubtotal = $callCosts + $recordingCosts + $membershipCosts + $faxCosts + $numberCosts;

        $tax = self::resolvePrimaryTax($workspace);
        $taxAmount = InvoiceHelper::calculateTax($invoiceSubtotal, $tax);
        $invoiceTotal = $invoiceSubtotal + $taxAmount;
        $invoiceNo = sprintf('%s-%d-%s', $invoicePrefix, $workspace->id, $now->format('YmdHis'));
        $deduplicationKey = sprintf('%s:%d:%s', $period, $workspace->id, $rangeStart->format('Y-m-d'));

        $existingInvoice = UserInvoice::where('deduplication_key', $deduplicationKey)
            ->where('workspace_id', $workspace->id)
            ->first();
        if ($existingInvoice) {
            $lineItems = UserInvoiceLineItem::where('invoice_id', $existingInvoice->id)->get()->map(function ($item) {
                return self::toQueueLineItem($item);
            })->toArray();

            return [
                'invoice' => $existingInvoice,
                'tax' => $tax,
                'line_items' => $lineItems
            ];
        }

        $invoice = UserInvoice::create([
            'invoice_no' => $invoiceNo,
            'due_date' => $dueDate,
            'status' => PaymentStatus::PENDING,
            'source' => InvoiceSource::SUBSCRIPTION,
            'cents' => $invoiceSubtotal,
            'cents_including_taxes' => $invoiceTotal,
            'cents_taxes' => $taxAmount,
            'tax_metadata' => [],
            'user_id' => $owner->id,
            'workspace_id' => $workspace->id,
            'deduplication_key' => $deduplicationKey,
            'call_costs' => $callCosts,
            'recording_costs' => $recordingCosts,
            'fax_costs' => $faxCosts,
            'membership_costs' => $membershipCosts,
            'number_costs' => $numberCosts
        ]);

        $invoice->created_at = $rangeStart;
        $invoice->updated_at = $rangeStart;
        $invoice->save();

        $lineItems = self::createLineItems($invoice, $period, [
            'call_costs' => $callCosts,
            'recording_costs' => $recordingCosts,
            'fax_costs' => $faxCosts,
            'membership_costs' => $membershipCosts,
            'number_costs' => $numberCosts
        ]);

        return [
            'invoice' => $invoice,
            'tax' => $tax,
            'line_items' => $lineItems
        ];
    }

    private static function createLineItems(UserInvoice $invoice, $period, array $items)
    {
        $isAnnual = strtoupper($period) === 'ANNUAL';
        if ($isAnnual) {
            $labelPrefix = 'Annual ';
        } else {
            $labelPrefix = '';
        }

        $lineItems = [];

        $lineItem = UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'call_costs',
            'name' => $labelPrefix . 'Call costs',
            'cents' => $items['call_costs'],
            'is_recurring' => false
        ]);
        $lineItems[] = self::toQueueLineItem($lineItem);

        $lineItem = UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'recording_costs',
            'name' => $labelPrefix . 'Recording costs',
            'cents' => $items['recording_costs'],
            'is_recurring' => false
        ]);
        $lineItems[] = self::toQueueLineItem($lineItem);

        $lineItem = UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'fax_costs',
            'name' => $labelPrefix . 'Fax costs',
            'cents' => $items['fax_costs'],
            'is_recurring' => false
        ]);
        $lineItems[] = self::toQueueLineItem($lineItem);

        $lineItem = UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'membership_costs',
            'name' => $labelPrefix . 'Membership costs',
            'cents' => $items['membership_costs'],
            'is_recurring' => true
        ]);
        $lineItems[] = self::toQueueLineItem($lineItem);

        $lineItem = UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'number_costs',
            'name' => $labelPrefix . 'Number costs',
            'cents' => $items['number_costs'],
            'is_recurring' => true
        ]);
        $lineItems[] = self::toQueueLineItem($lineItem);

        return $lineItems;
    }

    private static function toQueueLineItem(UserInvoiceLineItem $lineItem)
    {
        return [
            'key_name' => (string) $lineItem->key_name,
            'name' => (string) $lineItem->name,
            'cents' => (int) $lineItem->cents,
            'is_recurring' => (bool) $lineItem->is_recurring
        ];
    }

    private static function buildInvoiceTaskPayload(User $owner, Workspace $workspace, $period, array $invoiceData)
    {
        $invoice = $invoiceData['invoice'];
        $tax = $invoiceData['tax'];
        $lineItems = $invoiceData['line_items'];

        $runPrefix = 'run_mtly';
        if ($period === 'ANNUAL') {
            $runPrefix = 'run_annl';
        }
        $runId = sprintf('%s_%s_%s', $runPrefix, date('Y_m_d'), uniqid());

        $taxMetadata = [];
        if ($tax) {
            $taxMetadata['tax_type'] = (string) $tax->name;
            $taxMetadata['rate'] = sprintf('%s%%', $tax->tax_percentage);
            if (!empty($tax->region_id)) {
                $taxMetadata['region_id'] = (int) $tax->region_id;
            }
        }

        $dueDateUtc = null;
        if (!empty($invoice->due_date)) {
            if ($invoice->due_date instanceof \DateTimeInterface) {
                $dueDate = new DateTime($invoice->due_date->format('Y-m-d H:i:s'));
            } else {
                $dueDate = new DateTime((string) $invoice->due_date);
            }
            $dueDate->setTimezone(new DateTimeZone('UTC'));
            $dueDateUtc = $dueDate->format('Y-m-d\TH:i:s\Z');
        }

        return [
            'run_id' => $runId,
            'workspace_id' => (int) $workspace->id,
            'creator_id' => (int) $owner->id,
            'invoice_no' => (string) $invoice->invoice_no,
            'due_date' => $dueDateUtc,
            'cents' => (int) $invoice->cents,
            'cents_including_taxes' => (int) $invoice->cents_including_taxes,
            'cents_taxes' => (int) $invoice->cents_taxes,
            'tax_metadata' => $taxMetadata,
            'call_costs' => (int) $invoice->call_costs,
            'recording_costs' => (int) $invoice->recording_costs,
            'fax_costs' => (int) $invoice->fax_costs,
            'membership_costs' => (int) $invoice->membership_costs,
            'number_costs' => (int) $invoice->number_costs,
            'line_items' => $lineItems
        ];
    }

    private static function getInvoiceData(User $owner, Workspace $workspace, $invoiceId)
    {
        $invoice = UserInvoice::where('id', $invoiceId)
            ->where('workspace_id', $workspace->id)
            ->firstOrFail();
        $lineItems = UserInvoiceLineItem::where('invoice_id', $invoice->id)->get()->map(function ($item) {
            return self::toQueueLineItem($item);
        })->toArray();
        $tax = self::resolvePrimaryTax($workspace);

        return [
            'invoice' => $invoice,
            'tax' => $tax,
            'line_items' => $lineItems
        ];
    }
}
