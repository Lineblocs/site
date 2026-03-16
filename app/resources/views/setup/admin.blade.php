@extends('layouts.setup')
@section('title') Admin Setup :: @parent @endsection
@section('setup_step', 5)
@section('content')
<div class="admin-wrap">
    <div class="admin-card">
        <div class="admin-head">
            <span class="setup-kicker">Step 5</span>
            <h1 class="admin-title">Create administrator account</h1>
            <p class="admin-subtitle">
                Configure the primary admin credentials used to sign in and manage your Lineblocs installation.
            </p>
        </div>

        <div class="admin-alert">
            Use a secure email and strong password combination for your owner-level administrator account.
        </div>

        <div class="admin-grid">
            <div class="admin-pane">
                <h4>Admin Credentials</h4>
                <form method="POST" data-setup-form>
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email', $email) }}" />
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input id="admin_password" type="password" class="form-control {{ $errors->has('admin_password') ? 'is-invalid' : '' }}" name="admin_password" value="" />
                        @if ($errors->has('admin_password'))
                            <div class="invalid-feedback">{{ $errors->first('admin_password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="admin_cpassword" type="password" class="form-control {{ $errors->has('admin_cpassword') ? 'is-invalid' : '' }}" name="admin_cpassword" value="" />
                        <span class="admin-note">Both password fields must match before continuing.</span>
                        @if ($errors->has('admin_cpassword'))
                            <div class="invalid-feedback">{{ $errors->first('admin_cpassword') }}</div>
                        @endif
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="admin-actions">
                        <a href="/setup/smtp" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary" data-loading-text="Securing admin account...">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="admin-pane">
                <h4>What this enables</h4>
                <ul class="admin-points">
                    <li>Secure access to platform-level admin controls.</li>
                    <li>Ownership of system settings, billing, and operational tools.</li>
                    <li>Initial account used for future user and permission management.</li>
                    <li>Final steps toward completing your setup wizard.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
