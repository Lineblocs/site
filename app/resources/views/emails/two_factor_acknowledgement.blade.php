@extends('emails.layouts.header')
@section('title')
Two-Factor Authentication Updated
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
                                    <td style="padding: 18px 10px 14px; font-size: 18px; line-height: 28px; color: #1c2434; font-weight: 700;">
                                        Hello {{ $user->getName() }},
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 10px 18px; font-size: 15px; line-height: 24px; color: #24324b;">
                                        {{ $description }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 10px 18px; font-size: 15px; line-height: 24px; color: #24324b;">
                                        If you did not make this change, please review your account security settings immediately.
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
