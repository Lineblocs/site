<?php

namespace App\Helpers;

use Config;
use DateTime;
use Mail;
use App\User;
use App\Workspace;
use App\ServicePlan;
use App\BillingTax;
use App\UserInvoice;
use App\UserInvoiceLineItem;
use App\CustomizationsKVStore;

final class WorkspaceInvoiceHelper
{
    public static function sendInvoiceForWorkspace(Workspace $workspace, $period)
    {
        $period = strtoupper($period);
        if ($period !== 'MONTHLY' && $period !== 'ANNUAL') {
            throw new \Exception('Invalid invoice period. Use MONTHLY or ANNUAL.');
        }

        $owner = User::find($workspace->creator_id);
        if (!$owner || empty($owner->email)) {
            throw new \Exception(sprintf('Owner email missing for workspace #%d.', $workspace->id));
        }

        self::normalizeWorkspacePlan($workspace);

        $invoice = self::createInvoice($owner, $workspace, $period);
        $pdf = InvoiceHelper::generatePrettyInvoice($owner, $workspace, $invoice)->output();

        $subjectPrefix = $period === 'ANNUAL' ? 'annual' : 'monthly';
        $subject = sprintf('%s %s invoice', MainHelper::getSiteName(), $subjectPrefix);
        $mailConfig = Config::get('mail');
        $siteName = MainHelper::getSiteName();
        $customizations = CustomizationsKVStore::getRecord();
        $filePrefix = $period === 'ANNUAL' ? 'annual' : 'monthly';

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
            'period' => $period
        ];
    }

    private static function normalizeWorkspacePlan(Workspace $workspace)
    {
        $plan = ServicePlan::where('key_name', $workspace->plan)->first();
        if ($plan) {
            return;
        }

        $fallbackPlan = ServicePlan::where('pay_as_you_go', '1')->first();
        if (!$fallbackPlan) {
            $fallbackPlan = ServicePlan::first();
        }

        if (!$fallbackPlan) {
            throw new \Exception('No ServicePlan records available for fallback.');
        }

        $workspace->plan = $fallbackPlan->key_name;
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

        return BillingTax::where('name', 'GST')->first();
    }

    private static function createInvoice(User $owner, Workspace $workspace, $period)
    {
        $period = strtoupper($period);
        $multiplier = $period === 'ANNUAL' ? 12 : 1;
        $now = new DateTime();

        if ($period === 'ANNUAL') {
            $rangeStart = (new DateTime())->modify('first day of january this year')->setTime(0, 0, 0);
            $dueDate = (new DateTime())->modify('last day of december this year')->setTime(23, 59, 59);
            $invoicePrefix = 'A';
        } else {
            $rangeStart = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
            $dueDate = (new DateTime())->modify('last day of this month')->setTime(23, 59, 59);
            $invoicePrefix = 'M';
        }

        $callCosts = (100 * 20) * $multiplier;
        $recordingCosts = (100 * 20) * $multiplier;
        $membershipCosts = (100 * 20) * $multiplier;
        $faxCosts = (100 * 20) * $multiplier;
        $numberCosts = (100 * 20) * $multiplier;
        $invoiceSubtotal = $callCosts + $recordingCosts + $membershipCosts + $faxCosts + $numberCosts;

        $tax = self::resolvePrimaryTax($workspace);
        $taxAmount = InvoiceHelper::calculateTax($invoiceSubtotal, $tax);
        $invoiceTotal = $invoiceSubtotal + $taxAmount;
        $invoiceNo = sprintf('%s-%d-%s', $invoicePrefix, $workspace->id, $now->format('YmdHis'));

        $invoice = UserInvoice::create([
            'invoice_no' => $invoiceNo,
            'due_date' => $dueDate,
            'status' => 'INCOMPLETE',
            'source' => 'MANUAL',
            'cents' => $invoiceSubtotal,
            'cents_including_taxes' => $invoiceTotal,
            'cents_taxes' => $taxAmount,
            'tax_metadata' => [],
            'user_id' => $owner->id,
            'workspace_id' => $workspace->id,
            'call_costs' => $callCosts,
            'recording_costs' => $recordingCosts,
            'fax_costs' => $faxCosts,
            'membership_costs' => $membershipCosts,
            'number_costs' => $numberCosts
        ]);

        $invoice->created_at = $rangeStart;
        $invoice->updated_at = $rangeStart;
        $invoice->save();

        self::createLineItems($invoice, $period, [
            'call_costs' => $callCosts,
            'recording_costs' => $recordingCosts,
            'fax_costs' => $faxCosts,
            'membership_costs' => $membershipCosts,
            'number_costs' => $numberCosts
        ]);

        return $invoice;
    }

    private static function createLineItems(UserInvoice $invoice, $period, array $items)
    {
        $isAnnual = strtoupper($period) === 'ANNUAL';
        $labelPrefix = $isAnnual ? 'Annual ' : '';

        UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'call_costs',
            'name' => $labelPrefix . 'Call costs',
            'cents' => $items['call_costs'],
            'is_recurring' => false
        ]);

        UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'recording_costs',
            'name' => $labelPrefix . 'Recording costs',
            'cents' => $items['recording_costs'],
            'is_recurring' => false
        ]);

        UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'fax_costs',
            'name' => $labelPrefix . 'Fax costs',
            'cents' => $items['fax_costs'],
            'is_recurring' => false
        ]);

        UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'membership_costs',
            'name' => $labelPrefix . 'Membership costs',
            'cents' => $items['membership_costs'],
            'is_recurring' => true
        ]);

        UserInvoiceLineItem::create([
            'invoice_id' => $invoice->id,
            'key_name' => 'number_costs',
            'name' => $labelPrefix . 'Number costs',
            'cents' => $items['number_costs'],
            'is_recurring' => true
        ]);
    }
}
