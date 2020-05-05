<h2>Unkown Device Login</h2>

<div>
    <h5>Hello {{$user->getName()}},</h5>
    <p>an unknown device recently tried to login to your account. details below:</p>
    <span><strong>User Agent:</strong> {{$detect->getUserAgent()}}</span>
    <br/>
    <br/>
    <p>If this was not you please take steps to secure your account immediately.</p>
</div>
