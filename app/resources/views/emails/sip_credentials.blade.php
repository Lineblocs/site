@extends('emails.layouts.header')
@section('title')
SIP Credentials
@endsection
@section('content')

<!-- Body Content One Column Start  -->
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
                                    <td valign="top" height="20"
                                        style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top"
                                        style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: center;">
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;"
                                        height="30">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" valign="top" class="vspacer10" height="3"
                                        style="mso-line-height-rule:exactly; font-size:1px; line-height:3px; border-top: 2px solid #f4f7fa;">
                                        &nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" height="15"
                                        style="mso-line-height-rule:exactly;font-size:1px;line-height:1px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            class="paragraph_block block-1" role="presentation"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                            width="100%">
                                            <tr>
                                                <td class="pad"
                                                    style="padding-bottom: 10px; padding-left: 30px; padding-right: 30px; padding-top: 10px;">
                                                    <div
                                                        style="color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 16px; line-height: 150%; text-align: left; mso-line-height-alt: 24px;">
                                                        <h5 style="font-size: 28px; margin: 0;">How To Connect</h5>
                                                        <br />
                                                        <p style="margin: 0; word-break: break-word;">to connect to your extension please use the following login credentials</p>
                                                        <br />
                                                        <p style="margin: 0; word-break: break-word;">SIP Server: {{$host}}</p>
                                                        <p style="margin: 0; word-break: break-word;">User: {{$username}}</p>
                                                        <p style="margin: 0; word-break: break-word;">Secret: {{$password}}</p>
                                                        <p style="margin: 0; word-break: break-word;">Full SIP address: {{$username}}@{{$host}}</p>
                                                        <p style="margin: 0; word-break: break-word;">TCP Port: {{$tcp_port ?? 5065}}</p>
                                                        <p style="margin: 0; word-break: break-word;">Websocket gateway: {{$websocket_settings['gateway'] ?? 'wss://' . $host . ':7443'}}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="line-height: 1px; mso-line-height-rule: exactly; font-size: 0;" height="20">&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" valign="top" class="vspacer10" height="3"
                        style="mso-line-height-rule:exactly; font-size:1px; line-height:3px; border-top: 2px solid #f4f7fa;">
                        &nbsp;</td>
                </tr>

                <tr>
                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="line-height: 10px; mso-line-height-rule: exactly; font-size: 0;" height="10">&nbsp;</td>
                </tr>

            </tbody>
        </table>
    </td>
</tr>
@endsection