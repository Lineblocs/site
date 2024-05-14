@extends('emails.layouts.header')
@section('title')
Card expiring soon
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
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px; font-size: 24px;"><strong>Credit card expiring soon</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 100px; border-radius: 5px; background-color: #f4f7fa;">
                            <p style="font-family: Arial, sans-serif; color: #666666; margin-bottom: 5px;">Credit card ending in {{$ending_digits}} will expire in {{$days}} days. Please update your credit card details to avoid disruption.</p>
                        </td>
                    </tr>
                 </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection