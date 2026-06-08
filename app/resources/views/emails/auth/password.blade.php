@extends('emails.layouts.alert_email')
@section('title')
Password Reset
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
                                    <td valign="top" style="padding:22px 30px 18px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#393d47;font-size:16px;line-height:24px;text-align:left;">
                                        <h2 style="margin:0 0 8px;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">Reset your password</h2>
                                        <p style="margin:0;color:#5f6b7a;">To reset your password, use the secure link below.</p>
                                        <p style="margin:16px 0 0;">
                                            <a href="{{ url('password/reset', [$token]) }}" style="color:#3f51b5;font-weight:700;">Reset Password</a>
                                        </p>
                                        <p style="margin:16px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">This link will expire in {{ config('auth.reminder.expire', 60) }} minutes.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="30" class="hide">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection
