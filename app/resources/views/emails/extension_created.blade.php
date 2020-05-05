@extends('emails.layouts.alert_email')
@section('title')
Congratulations
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
                                        This email confirms you have created a new extension {{$extension->username}}
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
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                            class="SubContainer" style="border-radius: 3px;">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table align="left" width="100%" border="0" cellspacing="0"
                                                            cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="50%" align="left"
                                                                        style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; text-align: left;">
                                                                        SIP Server
                                                                    </td>
                                                                    <td width="50%" align="left"
                                                                        style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; font-weight: bold; text-align: left;">
                                                                        {{$workspace->sipURL()}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="50%" align="left"
                                                                        style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; text-align: left;">
                                                                        Username
                                                                    </td>
                                                                    <td width="50%" align="left"
                                                                        style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; text-align: left;">
                                                                        {{$extension->username}}

                                                                    </td>
                                                                </tr>
                                                                <td width="50%" align="left"
                                                                    style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; text-align: left;">
                                                                    Secret
                                                                </td>
                                                                <td width="50%" align="left"
                                                                    style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:12px;line-height:23px;color:#252f5a; text-align: left;">
                                                                    {{$extension->secret}}

                                                                </td>
                                                </tr>

                                            </tbody>
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
