@extends('layouts.setup')
@section('title') SMTP Setup :: @parent @endsection
@section('content')
<div class="smtp-wrap">
    <div class="smtp-card">
        <div class="smtp-head">
            <span class="setup-kicker">Step 4</span>
            <h1 class="smtp-title">Configure email delivery</h1>
            <p class="smtp-subtitle">
                Set up SMTP credentials so system emails, notifications, and account messages are delivered reliably.
            </p>
        </div>

        <div class="smtp-alert">
            Use an SMTP account dedicated to this platform to improve deliverability and troubleshooting.
        </div>

        <div class="smtp-grid">
            <div class="smtp-pane">
                <h4>SMTP Credentials</h4>
                <form method="POST">
                    <div class="form-group">
                        <label>Host</label>
                        <input id="smtp_host" type="text" class="form-control" name="smtp_host" value="{{ $smtp_host }}" autocomplete="off" />
                    </div>

                    <div class="form-group">
                        <label>User</label>
                        <input id="smtp_user" type="text" class="form-control" name="smtp_user" value="{{ $smtp_user }}" autocomplete="off" />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input id="smtp_password" type="text" class="form-control" name="smtp_password" value="{{ $smtp_password }}" autocomplete="off" />
                    </div>

                    <div class="form-group">
                        <label>TLS</label>
                        <select id="smtp_tls" class="form-control" name="smtp_tls">
                            <option value="1" {{ (string) $smtp_tls === '1' ? 'selected' : '' }}>On</option>
                            <option value="0" {{ (string) $smtp_tls === '0' ? 'selected' : '' }}>Off</option>
                        </select>
                        <span class="smtp-note">Enable TLS unless your mail provider explicitly requires plain SMTP.</span>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="smtp-actions">
                        <a href="/setup/payments" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="smtp-pane">
                <h4>What this enables</h4>
                <ul class="smtp-points">
                    <li>Send signup, password reset, and operational notification emails.</li>
                    <li>Deliver system alerts and workflow messages to admins and users.</li>
                    <li>Improve inbox placement with provider-specific SMTP routing.</li>
                    <li>Prepare your platform for reliable transactional communication.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
