@extends('emails.layouts.alert_email')
@section('title')
Email Verification
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
                                        {{$user->getName()}}, please use link below to verify your email on lineblocs
                                        <br /><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 40px; width: 220px; font-family: arial,helvetica,sans-serif; font-size: 14px; letter-spacing: 1px; text-align: center; color: #ffffff; border-radius: 3px;"
                                        align="left" bgcolor="#3f51b5"><a href="{{$link}}"
                                            style="font-family:'Roboto', Arial, Helvetica, sans-serif; text-decoration: none; color: #ffffff; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Confirm
                                            your email</a></td>
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

                                            </tbody>
                                        </table>
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