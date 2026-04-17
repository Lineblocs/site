@extends('emails.layouts.header')
@section('title')
Contact Details
@endsection
@section('content')
<!-- Body Content One Column Start  -->
<tr>
    <td valign="top" class="mobilespacer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td style="padding: 32px 24px; border-radius: 12px; background-color: #f8fafc;">
                        <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>First
                                Name:</strong> {{$first_name}}</p>
                        <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Last
                                Name:</strong> {{$last_name}}</p>
                        <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;">
                            <strong>Email:</strong> {{$email}}</p>
                        <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 15px;">
                            <strong>Comments:</strong> {{$comments}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection
