<h2>Password Reset</h2>

<div>
  To reset your password, complete this form: <a href="{{ Config::get('app.portal_url').'/'.'#/reset?token=' . $token }}">Click Here</a>
<br /><br / > 
This link will expire in {{ config('auth.reminder.expire', 60) }} minutes.
</div>
