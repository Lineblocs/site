@extends('emails.layouts.alert_email')
@section('title')
Support ticket created
@endsection
@section('content')
<?php
    $ticketComment = isset($ticket->comment) ? $ticket->comment : (isset($ticket->comments) ? $ticket->comments : '');
?>
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
                                        <p style="font-family:Roboto, Arial, sans-serif; color:#395373; font-size:16px; line-height:24px; font-weight:bold; margin:0;">Your support ticket was created</p>
                                        <p style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; margin:4px 0 0 0;">Our support team has received your request and will review it shortly.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:18px 22px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                @if(isset($ticket->public_id) && !empty($ticket->public_id))
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Ticket ID</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $ticket->public_id }}</td>
                                                </tr>
                                                @endif
                                                @if(isset($user) && isset($user->email))
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Requester</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $user->email }}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0; border-bottom:1px solid #edf1f5;">Subject</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0; border-bottom:1px solid #edf1f5;">{{ $ticket->subject }}</td>
                                                </tr>
                                                @if(isset($ticketLink) && !empty($ticketLink))
                                                <tr>
                                                    <td width="32%" style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:8px 12px 8px 0;">Ticket Link</td>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:20px; padding:8px 0;"><a href="{{ $ticketLink }}" style="color:#395373; text-decoration:none;">View ticket</a></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 22px 22px 22px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f8fafc; border-radius:6px;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#667085; font-size:13px; line-height:20px; padding:14px 16px 0 16px;">Message</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Roboto, Arial, sans-serif; color:#1f2937; font-size:14px; line-height:22px; padding:6px 16px 16px 16px;">{!! nl2br(e($ticketComment)) !!}</td>
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
