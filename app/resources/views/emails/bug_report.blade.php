@extends('emails.layouts.alert_email')

@section('preheader')
New bug report details.
@endsection

@section('title')
Bug report
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
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 16px; line-height: 25px; color: #344054; padding-bottom: 18px;">
                                                        A new bug report has been submitted. Details are below.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation" style="border: 1px solid #e1e7ef; border-radius: 5px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">First name</td>
                                                                    <td class="mobile-value" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828; font-weight: bold;">{{ $first_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">Last name</td>
                                                                    <td class="mobile-value" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828; font-weight: bold;">{{ $last_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">Email</td>
                                                                    <td class="mobile-value" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828; font-weight: bold; word-break: break-word;">{{ $email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">Phone</td>
                                                                    <td class="mobile-value" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828;">{{ $phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">Bug type</td>
                                                                    <td class="mobile-value" style="padding: 12px 14px; border-bottom: 1px solid #e1e7ef; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828;">{{ $bug_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="mobile-label" width="34%" valign="top" style="padding: 12px 14px; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085;">Comments</td>
                                                                    <td class="mobile-value" valign="top" style="padding: 12px 14px; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 22px; color: #101828; word-break: break-word;">{{ $comments }}</td>
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
            </tbody>
        </table>
    </td>
</tr>
@endsection
