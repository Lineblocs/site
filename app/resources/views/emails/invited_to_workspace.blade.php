@extends('emails.layouts.account_invite')
@section('title') About :: @parent @endsection
@section('content')
        <tr>
            <td valign="top" class="mobilespacer">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="100" class="hide">&nbsp;</td>
                        <td class="mobilespacer2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td valign="top" height="70" class="vspacer40" style="mso-line-height-rule:exactly; font-size:1px; line-height:1px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" style="font-family:Roboto, Arial, sans-serif;font-size:28px;line-height:36px;color:#0a1247;font-weight: bold; text-align: left;">Hello {{$newUser->first_name}} {{$newUser->last_name}} you have been invited to join workspace {{$workspace->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
If you would like to join this workspace please use the link below.<br /><br />
                                    </td>
                                </tr>  
                                 <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                                </tr>                              
                                <tr>
                                    <td>
                                        <table align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="height: 40px; width: 170px; font-family: arial,helvetica,sans-serif; font-size: 16px; letter-spacing: 1px; text-align: center; color: #ffffff; border-radius: 3px;" align="left" bgcolor="#3f51b5"><a href="{{$link}}" style="font-family:'Roboto', Arial, Helvetica, sans-serif; text-decoration: none; color: #ffffff; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Accept Invitation</a></td>
                                                </tr>
                                                <tr>
                                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height: 20px; mso-line-height-rule: exactly; font-size: 0;" height="20">&nbsp;</td>
                                </tr> 

                            </table>
                        </td>
                        <td width="100" class="hide">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>

@endsection
