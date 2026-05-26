@extends('emails.layouts.header')

@section('preheader')
Your support ticket has a new update.
@endsection

@section('title')
Support ticket updated
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
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085; padding-bottom: 4px;">
                                                        Subject
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 17px; line-height: 25px; color: #101828; font-weight: bold; padding-bottom: 18px; word-break: break-word;">
                                                        {{ $ticket->subject }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; color: #667085; padding-bottom: 4px;">
                                                        Comments
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 15px; line-height: 24px; color: #344054; word-break: break-word;">
                                                        {!! nl2br(e($update->comments)) !!}
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
