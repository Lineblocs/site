@extends('emails.layouts.alert_email')
@section('title')
Reset Your Password
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
                                        <h2 style="margin:0 0 8px;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">Reset your password</h2>
                                        <p style="margin:0;color:#5f6b7a;">We received a request to reset the password for your account.</p>

                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:20px;">
                                            <tr>
                                                <td bgcolor="#0a1247" style="border-radius:4px;">
                                                    <a href="{{ \App\Helpers\MainHelper::createPortalLink('#/reset?token=' . $token) }}" style="display:inline-block;padding:12px 20px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:15px;line-height:20px;color:#ffffff;text-decoration:none;font-weight:700;">Reset Password</a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:18px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">This link will expire in {{ config('auth.reminder.expire', 60) }} minutes. If you did not request a password reset, you can safely ignore this email.</p>
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
