@extends('emails.layouts.header')
@section('title')
Account Suspended
@endsection
@section('content')

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
                                        <h2 style="margin:0 0 8px;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">Your workspace has been suspended</h2>
                                        <p style="margin:0;">Dear {{ $owner ? $owner->getName() : 'Customer' }},</p>
                                        <p style="margin:12px 0 0;color:#5f6b7a;">Your workspace access has been suspended because billing is past due. Please update your billing information or pay the outstanding invoice to restore service.</p>

                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:18px;border:1px solid #e5e7eb;border-radius:6px;">
                                            <tr>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;width:42%;">Workspace</td>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{ $workspace->name }} (#{{ $workspace_id }})</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">Suspended At</td>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;">{{ $suspended_at }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">Reason</td>
                                                <td style="padding:12px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;">{{ $reason }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:12px 16px;font-size:13px;line-height:20px;color:#6b7280;">Grace Period Extension</td>
                                                <td style="padding:12px 16px;font-size:15px;line-height:20px;color:#111827;">{{ $grace_period_extension_days === null ? 'None' : $grace_period_extension_days . ' days' }}</td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">After payment is resolved, contact support if your workspace is not restored automatically.</p>
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
