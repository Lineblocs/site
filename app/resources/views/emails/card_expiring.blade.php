@extends('emails.layouts.header')

@section('preheader')
Your saved card is expiring soon.
@endsection

@section('title')
Card expiring soon
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
                                    <td class="feedback-card" bgcolor="#f7f9fc" style="padding: 30px 32px; border-radius: 6px; border: 1px solid #e7edf5;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 18px; line-height: 26px; color: #101828; font-weight: bold; padding-bottom: 12px;">
                                                        Credit card expiring soon
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; color: #344054;">
                                                        Credit card ending in {{ $ending_digits }} will expire in {{ $days }} days. Please update your credit card details to avoid disruption.
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
