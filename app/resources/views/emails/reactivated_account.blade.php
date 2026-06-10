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
                                    <td align="left" valign="top" style="font-family:Roboto, Arial, sans-serif;font-size:28px;line-height:36px;color:#0a1247;font-weight: bold; text-align: left;">Hello {{$workspaceUser->first_name}} {{$workspaceUser->last_name}}, your account has been reactivated
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" height="20" style="mso-line-height-rule:exactly;font-size:1px;line-height:20px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" style="font-family:'Roboto', Arial, Helvetica, sans-serif; font-size:14px;line-height:23px;color:#252f5a; text-align: left;">
Your account in workspace {{$workspace->name}} has been reactivated. You can now access the workspace again. If you have any questions, please contact your workspace administrator.<br /><br />
                                    </td>
                                </tr>  
                                 <tr>
                                    <td style="line-height: 30px; mso-line-height-rule: exactly; font-size: 0;" height="30">&nbsp;</td>
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
