@extends('emails.layouts.header')
@section('title')
Quote Request
@endsection
@section('content')
<tr>
    <td valign="top" class="mobilespacer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ffffff;">
            <tbody>
                <tr>
                    <td style="padding:0 0 22px 0;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #e5eaf0; border-radius:8px; background-color:#ffffff;">
                            <tbody>
                                <tr>
                                    <td style="padding:20px 22px; border-bottom:1px solid #e5eaf0;">
                                        <p style="font-family:Roboto, Arial, sans-serif; color:#395373; font-size:16px; line-height:24px; font-weight:bold; margin:0;">New quote request</p>
                                        <p style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; margin:4px 0 0 0;">A visitor asked for pricing and follow-up.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:18px 22px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">First Name</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Last Name</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Company</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ !empty($company_name) ? $company_name : 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Team Size</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ !empty($team_size) ? $team_size : 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Phone</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0;">Email</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0;"><a href="mailto:{{ $email }}" style="color:#395373; text-decoration:none;">{{ $email }}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 22px 22px 22px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f8fafc; border-radius:6px;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:14px 16px 0 16px;">Comments</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:22px; padding:6px 16px 16px 16px;">{!! nl2br(e($comments)) !!}</td>
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
