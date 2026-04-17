@extends('emails.layouts.header')
@section('title')
One-Time Login Link
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
                                        We received a request for a one-time login link for workspace #{{ $workspace->id }}.
                                        This link expires in {{ $expires_minutes }} minutes and can only be used once.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 8px 10px 20px;">
                                        <a href="{{ $login_link }}" style="display:inline-block;background:#395373;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:4px;">
                                            Login Once
                                        </a>
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
