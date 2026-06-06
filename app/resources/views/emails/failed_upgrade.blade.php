@extends('emails.layouts.alert_email')
@section('title')
Upgrade Failed
@endsection
@section('content')
<?php
$planName = isset($plan) && is_object($plan) ? ($plan->nice_name ?: $plan->name) : (isset($plan) ? $plan : 'your new plan');
$currentPlanName = isset($currentPlan) && is_object($currentPlan) ? ($currentPlan->nice_name ?: $currentPlan->name) : (isset($currentPlan) ? $currentPlan : null);
$newPlanName = isset($newPlan) && is_object($newPlan) ? ($newPlan->nice_name ?: $newPlan->name) : (isset($newPlan) ? $newPlan : $planName);
$userName = isset($user) ? trim($user->getName()) : '';
?>

<tr>
    <td valign="top" class="mobilespacer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td width="30" class="hide">&nbsp;</td>
                    <td class="mobilespacer2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td valign="top" height="12" style="mso-line-height-rule:exactly;font-size:1px;line-height:12px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" valign="top" height="3" style="mso-line-height-rule:exactly;font-size:1px;line-height:3px;border-top:2px solid #f4f7fa;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" style="padding:22px 30px 18px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#393d47;font-size:16px;line-height:24px;text-align:left;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td width="54" valign="top">
                                                    <table width="44" height="44" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fef2f2;border-radius:22px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="font-size:24px;line-height:24px;color:#dc2626;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">&#10007;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="middle">
                                                    <h2 style="margin:0;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">We couldn't upgrade your plan</h2>
                                                    <p style="margin:4px 0 0;color:#5f6b7a;font-size:14px;line-height:21px;">There was an issue processing your payment.</p>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;">Hello {{ $userName !== '' ? $userName : 'there' }},</p>
                                        <p style="margin:12px 0 0;color:#5f6b7a;">This email is to notify you that we couldn't process the payment to upgrade your workspace plan. Your plan has not been upgraded.</p>

                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:18px;border:1px solid #e5e7eb;border-radius:6px;">
                                            @if ($currentPlanName)
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;width:38%;">Current Plan</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{ $currentPlanName }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;width:38%;">Requested Plan</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{ $newPlanName }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">Upgrade Status</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#dc2626;font-weight:700;">Failed</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;font-size:13px;line-height:20px;color:#6b7280;vertical-align:top;">What Happens Next</td>
                                                <td style="padding:13px 16px;font-size:15px;line-height:22px;color:#111827;">Your services will remain on the current plan. Please update your payment information so we can process your upgrade.</td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">You can review your billing details and update your payment method from your account dashboard at any time. Thank you for choosing {{$site_name ?? \App\Helpers\MainHelper::getSiteName()}}.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="30" class="hide">&nbsp;</td>
                </tr>
                <tr>
                    <td style="line-height:1px;mso-line-height-rule:exactly;font-size:0;" height="16">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection
