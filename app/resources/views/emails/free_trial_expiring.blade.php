<?php
if (empty($site_name)) {
    $site_name = \App\Helpers\MainHelper::getSiteName();
}
if (empty($customizations)) {
    $customizations = \App\CustomizationsKVStore::getRecord();
}
?>
@extends('emails.layouts.alert_email')

@section('title')
Your free trial just ended
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
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
                                        The 14-day trial for your account has ended, but your designs are still safe. If you forgot to enter billing information, you can still continue your service.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table align="center" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="height: 40px; width: 220px; font-family: arial,helvetica,sans-serif; font-size: 16px; letter-spacing: 1px; text-align: center; color: #ffffff; border-radius: 3px;" align="center" bgcolor="#3f51b5">
                                                        <a href="{{\App\Helpers\MainHelper::createAppUrl('/#/dashboard/billing')}}" style="font-family:'Roboto', Arial, Helvetica, sans-serif; text-decoration: none; color: #ffffff; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Continue service</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
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
