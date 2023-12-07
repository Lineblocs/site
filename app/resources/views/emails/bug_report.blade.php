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
                    <tr>
                        <td style="padding: 100px; border-radius: 5px; background-color: #f4f7fa;">
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>First Name:</strong> {{$first_name}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Last Name:</strong> {{$last_name}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Email:</strong> {{$email}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Phone</strong> {{$phone}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;"><strong>Bug Type</strong> {{$bug_type}}</p>
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 15px;"><strong>Comments:</strong> {{$comments}}</p>
                        </td>
                    </tr>
                 </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection