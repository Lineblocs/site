@extends('emails.layouts.header')
@section('title')
Call Delivery Warning
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
                                    <td valign="top" height="10"
                                        style="mso-line-height-rule:exactly;font-size:1px;line-height:10px;">&nbsp;</td>
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
                                                    style="padding-bottom: 15px; padding-left: 30px; padding-right: 30px; padding-top: 10px;">
                                                    <div
                                                        style="color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 16px; line-height: 150%; text-align: left; mso-line-height-alt: 24px;">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 18px;">
                                                            <tr>
                                                                <td width="58" valign="top">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="48" height="48" style="background-color:#fff4e5; border-radius:24px;">
                                                                        <tr>
                                                                            <td align="center" valign="middle" style="font-family: Arial, Helvetica, sans-serif; font-size: 27px; line-height: 27px; color:#d97706;">
                                                                                &#9888;
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td valign="middle" style="font-family: Arial, Helvetica Neue, Helvetica, sans-serif; color:#1f2937;">
                                                                    <p style="margin: 0; font-size: 22px; line-height: 28px; font-weight: 700; word-break: break-word;">
                                                                        Caller ID needs attention
                                                                    </p>
                                                                    <p style="margin: 4px 0 0; font-size: 14px; line-height: 21px; color:#6b7280; word-break: break-word;">
                                                                        A call was rejected because the caller ID was not accepted by the provider.
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <p style="margin: 0; word-break: break-word;">
                                                            Dear {{ isset($user->name) && $user->name ? $user->name : 'User' }},
                                                        </p>
                                                        <p style="margin: 0; word-break: break-word; margin-top: 15px;">
                                                            We detected a call delivery warning from the call activity service. Please review the details below.
                                                        </p>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 18px; border: 1px solid #e5e7eb; border-radius: 6px;">
                                                            <tr>
                                                                <td style="padding: 14px 16px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 15px; line-height: 23px; color:#393d47;">
                                                                    <strong>Run ID:</strong> {{ $run_id }}<br>
                                                                    <strong>Workspace ID:</strong> {{ $workspace_id }}<br>
                                                                    <strong>From:</strong> {{ $from }}<br>
                                                                    <strong>To:</strong> {{ $to }}<br>
                                                                    <strong>Description:</strong> {{ $description }}
                                                                </td>
                                                            </tr>
                                                        </table>
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
                    <td width="30" class="hide">&nbsp;</td>
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
