@extends('layouts.setup')
@section('title') Setup Welcome :: @parent @endsection
@section('setup_step', 0)
@section('content')
<div class="setup-welcome-wrap">
    <div class="setup-welcome-card">
        <span class="setup-kicker">Environment Setup</span>
        <h1 class="setup-title">Configure your Lineblocs platform</h1>
        <p class="setup-subtitle">
            This guided wizard will prepare storage, text-to-speech, payments, email delivery, and admin access.
            You can revise these settings anytime after onboarding.
        </p>

        <div class="setup-quick-list">
            <div class="setup-quick-item">1. Storage provider and region</div>
            <div class="setup-quick-item">2. Text-to-speech credentials</div>
            <div class="setup-quick-item">3. Stripe billing configuration</div>
            <div class="setup-quick-item">4. SMTP delivery and security</div>
            <div class="setup-quick-item">5. Administrator account setup</div>
            <div class="setup-quick-item">6. Workspace branding</div>
        </div>

        <div class="setup-actions">
            <a href="/setup/storage" class="btn btn-setup-primary">Start Setup</a>
            <a href="/" class="btn btn-setup-link">Back to Website</a>
        </div>
    </div>
</div>
@endsection
