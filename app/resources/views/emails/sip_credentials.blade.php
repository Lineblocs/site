@extends('emails.layouts.alert_email')
@section('title')
SIP Credentials
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
                                    <td valign="top" height="16" style="mso-line-height-rule:exactly;font-size:1px;line-height:16px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td style="padding:10px 30px 18px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#393d47;font-size:16px;line-height:24px;text-align:left;">
                                                    <h2 style="margin:0 0 8px;font-size:24px;line-height:30px;color:#0a1247;font-weight:700;">Your SIP credentials are ready</h2>
                                                    <p style="margin:0;color:#5f6b7a;">Use the details below to register your device, softphone, or SIP client.</p>

                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:20px;border:1px solid #e5e7eb;border-radius:6px;">
                                                        <tr>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;width:36%;">SIP Server</td>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$host}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">Username</td>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$username}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">Password / Secret</td>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$password}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">SIP Address</td>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$username}}@{{$host}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:13px;line-height:20px;color:#6b7280;">TCP Port</td>
                                                            <td style="padding:13px 16px;border-bottom:1px solid #e5e7eb;font-size:15px;line-height:20px;color:#111827;font-weight:700;">{{$tcp_port ?? 5065}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:13px 16px;font-size:13px;line-height:20px;color:#6b7280;">WebSocket Gateway</td>
                                                            <td style="padding:13px 16px;font-size:15px;line-height:20px;color:#111827;font-weight:700;word-break:break-word;">{{$websocket_settings['gateway'] ?? 'wss://' . $host . ':7443'}}</td>
                                                        </tr>
                                                    </table>

                                                    <p style="margin:18px 0 0;color:#5f6b7a;font-size:14px;line-height:22px;">Keep these credentials private. If you did not request this setup, please contact support so we can review your account.</p>
                                                </td>
                                            </tr>
                                        </table>
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
