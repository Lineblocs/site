@extends('emails.layouts.header')
@section('title')
Port Request Completed
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
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td width="54" valign="top">
                                                    <table width="44" height="44" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ecfdf3;border-radius:22px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="font-size:24px;line-height:24px;color:#16a34a;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">&#10003;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="middle">
                                                    <h2 style="margin:0;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">Your port is complete</h2>
                                                    <p style="margin:4px 0 0;color:#5f6b7a;font-size:14px;line-height:21px;">The number is now ready to use in your account.</p>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;">Hello {{$user->getName()}},</p>
                                        <p style="margin:12px 0 0;color:#5f6b7a;">Your port request for <strong style="color:#111827;">{{$port->number}}</strong> has been completed successfully.</p>

                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:18px;border:1px solid #e5e7eb;border-radius:6px;">
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;width:34%;">Phone Number</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$port->number}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;font-size:13px;line-height:20px;color:#6b7280;">Status</td>
                                                <td style="padding:13px 16px;font-size:15px;line-height:20px;color:#16a34a;font-weight:700;">Completed</td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">You can now assign this number to routing, users, or services from the user portal. If anything does not look right, contact support and we will help review it.</p>
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
