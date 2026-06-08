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
Debugger Error
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
                                        <h5 style="margin:0 0 12px;">Hello {{$creator->getName()}},</h5>
                                        <p style="margin:0 0 16px;">A {{\App\Helpers\MainHelper::getSiteName()}} error occurred during a call.</p>
                                        <p style="margin:0 0 8px;"><strong>Title:</strong> {{$params['title']}}</p>
                                        <p style="margin:0 0 8px;"><strong>Report:</strong></p>
                                        <p style="margin:0;">{{$params['report']}}</p>
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
