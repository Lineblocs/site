@extends('emails.layouts.header')
@section('title')
Port status confirmed
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
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: center;">
                                        <div>
                                            <h5 style="font-size: 28px;">Hello {{$user->getName()}},</h5>
                                            <p>We are emailing you to let you know that your port request for number {{$port->number}} was confirmed. the ETA for this port request is {{$port->eta}}. you can also see this ETA in the lineblocs user portal
                                            </p>                                            
                                            <br>
                                            <br>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" valign="top" class="vspacer10" height="3" style="mso-line-height-rule:exactly; font-size:1px; line-height:3px; border-top: 2px solid #f4f7fa;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" height="15" style="mso-line-height-rule:exactly;font-size:1px;line-height:1px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="SubContainer" style="border-radius: 3px;">
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
