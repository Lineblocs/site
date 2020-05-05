@extends('emails.layouts.verify_registration')
@section('title') About :: @parent @endsection
@section('content')
<tr>
            <td valign="top" class="mobilespacer">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                        <td width="60" class="hide">&nbsp;</td>
                        <td class="mobilespacer2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td valign="top" height="20" class="vspacer10" style="mso-line-height-rule:exactly; font-size:1px; line-height:1px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" style="font-family:Roboto, Arial, sans-serif;font-size:22px;line-height:30px;color:#0a1247;font-weight: normal; text-align: center;">Please confirm your email address
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" valign="top" class="vspacer10" height="3" style="mso-line-height-rule:exactly; font-size:1px; line-height:3px; border-top: 2px solid #ebfcfc;">&nbsp;</td>
                                  </tr>
                                 <tr>
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
{{$user->getName()}}, please use link below to verify your email on lineblocs<br>
                                    </td>
                                </tr>  
                                 <tr>
                                    <td style="line-height: 10px; mso-line-height-rule: exactly; font-size: 0;" height="10">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
Please use link below to verify your email on lineblocs.<br/>
                                    </td>
                                </tr>      
                                <tr>
                                    <td valign="top" height="30" style="mso-line-height-rule:exactly;font-size:1px;line-height:30px;">&nbsp;</td>
                                </tr>                         
                                <tr>
                                    <td>
                                        <table align="center">
                                            <tbody>
                                                <tr>
                                                    <td style="height: 40px; width: 220px; font-family: arial,helvetica,sans-serif; font-size: 14px; letter-spacing: 1px; text-align: center; color: #ffffff; border-radius: 3px;" align="left" bgcolor="#3f51b5"><a href="{{$link}}" style="font-family:'Roboto', Arial, Helvetica, sans-serif; text-decoration: none; color: #ffffff; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Confirm  your email</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height: 10px; mso-line-height-rule: exactly; font-size: 0;" height="10">&nbsp;</td>
                                </tr> 

                            </tbody></table>
                        </td>
                        <td width="60" class="hide">&nbsp;</td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        @endsection