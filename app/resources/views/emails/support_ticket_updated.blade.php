@extends('emails.layouts.header')
@section('title')
Support ticket updated
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
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Subject:</strong> {{$ticket->subject}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 15px;"><strong>Comments:</strong> {{$update->comments}}</p>
                        </td>
                    </tr>
                 </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection