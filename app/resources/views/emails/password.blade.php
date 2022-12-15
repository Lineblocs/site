<h2>Password Reset</h2>

<div>
  To reset your password, complete this form: <a href="{{ \App\Helpers\MainHelper::createPortalLink('#/reset?token=' . $token } }}">Click Here</a>
<br /><br / > 
This link will expire in {{ config('auth.reminder.expire', 60) }} minutes.
</div>
