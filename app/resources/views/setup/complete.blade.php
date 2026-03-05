@extends('layouts.setup')
@section('title') Setup Complete :: @parent @endsection
@section('content')
<div class="complete-wrap">
    <div class="complete-card">
        <span class="complete-kicker">Completed</span>
        <h1 class="complete-title">Lineblocs setup is complete</h1>
        <p class="complete-subtitle">
            Your core platform settings are now configured. You can sign in to the admin area and continue with
            advanced configuration whenever needed.
        </p>

        <ul class="complete-list">
            <li>Storage, speech, payments, email, and admin setup saved.</li>
            <li>Your installation is now ready for workspace onboarding.</li>
        </ul>

        <div class="complete-actions">
            <a href="/auth/login" class="btn btn-setup-primary">Login to Admin</a>
            <a href="/" class="btn btn-setup-link">Go to Website</a>
        </div>
    </div>
</div>
@endsection
