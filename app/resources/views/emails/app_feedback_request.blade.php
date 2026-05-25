@extends('emails.layouts.header')

@section('preheader')
Tell us how your recent experience went.
@endsection

@section('title')
How was your experience?
@endsection

@section('content')
<tr>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
            <tbody>
                <tr>
                    <td bgcolor="#ffffff" valign="top" style="padding: 0 0 28px 0;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                            <tbody>
                                <tr>
                                    <td class="feedback-card" bgcolor="#f7f9fc" style="padding: 34px 36px; border-radius: 6px; border: 1px solid #e7edf5;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 16px; line-height: 25px; color: #344054;">
                                                        <p style="margin: 0 0 16px 0;">Hi{{ !empty($user) ? ' ' . $user->getName() : '' }},</p>
                                                        <p style="margin: 0 0 22px 0;">Thanks for being a valued member. We would love to hear how your recent experience went, and your feedback helps us keep improving.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <table border="0" cellspacing="0" cellpadding="0" role="presentation" class="feedback-button-wrap">
                                                            <tr>
                                                                <td bgcolor="#3f51b5" align="center" style="border-radius: 4px;">
                                                                    <a href="{{ $feedbackLink }}" target="_blank" style="display: inline-block; padding: 13px 24px; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 16px; line-height: 20px; color: #ffffff; font-weight: bold; text-decoration: none; border-radius: 4px;">Leave feedback</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 20px; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 21px; color: #667085;">
                                                        It only takes a minute.
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
            </tbody>
        </table>
    </td>
</tr>
@endsection
