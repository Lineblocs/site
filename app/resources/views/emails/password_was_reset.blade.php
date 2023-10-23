@extends('emails.layouts.header')
@section('title')
Password Changed
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
                                        &nbsp;
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
                                        <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1"
                                            role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                            width="100%">
                                            <tr>
                                                <td class="pad"
                                                    style="width: 100%; padding-right: 0px; padding-left: 0px;">
                                                    <div align="center" class="alignment" style="line-height: 10px;">
                                                        <a href="{{\App\Helpers\MainHelper::createUrl()}}"
                                                            target="_blank">
                                                            <img src="{{\Config::get("app.url").'/email-images/'}}logo.png"
                                                                style="display: block; height: auto; border: 0; max-width: 238px; width: 100%;"
                                                                width="238" />
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
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