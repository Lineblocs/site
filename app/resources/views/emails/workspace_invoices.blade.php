@extends('emails.layouts.header')
@section('title')
Invoices
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
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 30px; color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 16px; line-height: 150%;">
                                        @if (!empty($period) && $period === 'ANNUAL')
                                            <h5 style="font-size: 26px; margin: 0 0 15px 0;">Annual Invoice</h5>
                                        @elseif (!empty($period) && $period === 'MONTHLY')
                                            <h5 style="font-size: 26px; margin: 0 0 15px 0;">Monthly Invoice</h5>
                                        @else
                                            <h5 style="font-size: 26px; margin: 0 0 15px 0;">Monthly and Annual Invoices</h5>
                                        @endif
                                        <p style="margin: 0 0 12px 0;">Hello {{ $user->name }},</p>
                                        @if (!empty($period) && $period === 'ANNUAL')
                                            <p style="margin: 0 0 12px 0;">
                                                Your annual invoice PDF is attached for workspace
                                                <strong>{{ $workspace->name }}</strong>.
                                            </p>
                                        @elseif (!empty($period) && $period === 'MONTHLY')
                                            <p style="margin: 0 0 12px 0;">
                                                Your monthly invoice PDF is attached for workspace
                                                <strong>{{ $workspace->name }}</strong>.
                                            </p>
                                        @else
                                            <p style="margin: 0 0 12px 0;">
                                                Your monthly and annual invoice PDFs are attached for workspace
                                                <strong>{{ $workspace->name }}</strong>.
                                            </p>
                                        @endif
                                        <p style="margin: 0;">Thank you,<br>{{ $site }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection
