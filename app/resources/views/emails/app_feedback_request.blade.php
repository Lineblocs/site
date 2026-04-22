@extends('emails.layouts.header')
@section('title')
Feedback request
@endsection
@section('content')
<!-- Body Content One Column Start  -->
<tr>
    <td valign="top" class="mobilespacer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <tr>
                        <td style="padding: 100px; border-radius: 5px; background-color: #f4f7fa;">
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;">Thanks for being a valued member. We would like to invite you to provide feedback about your experience. You can leave feedback for us by using the link below.</p>
                            <a href="{{$feedbackLink}}">Leave feedback</a>
                        </td>
                    </tr>
                 </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection