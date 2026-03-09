@extends('layouts.setup')
@section('title') Setup Already Complete :: @parent @endsection
@section('setup_step', 7)
@section('content')
<div class="already-wrap">
    <div class="already-card">
        <span class="already-kicker">Setup Locked</span>
        <h1 class="already-title">Setup is already completed</h1>
        <p class="already-subtitle">
            This installation has already finished onboarding. For security and consistency,
            the setup wizard is now read-only.
        </p>

        <ul class="already-list">
            <li>All core setup values were saved in the database.</li>
            <li>Administrator access is already configured.</li>
            <li>Use the dashboard to manage advanced settings.</li>
        </ul>

        <div class="already-actions">
            <a href="/auth/login" class="btn btn-setup-primary">Login to Admin</a>
            <a href="/" class="btn btn-setup-link">Go to Website</a>
            <a href="/setup/restart" class="btn btn-setup-link">Restart Setup</a>
        </div>
    </div>
</div>
@endsection
