@extends('layouts.setup')
@section('title') SMTP Setup :: @parent @endsection
@section('setup_step', 4)
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
                <form method="POST" data-setup-form>
                    <div class="setup-group">
                        <h5 class="setup-group-title">Server Connection</h5>
                        <div class="form-group">
                            <label>Host</label>
                            <input id="smtp_host" type="text" class="form-control {{ $errors->has('smtp_host') ? 'is-invalid' : '' }}" name="smtp_host" value="{{ old('smtp_host', $smtp_host) }}" autocomplete="off" />
                            @if ($errors->has('smtp_host'))
                                <div class="invalid-feedback">{{ $errors->first('smtp_host') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Port</label>
                            <input id="smtp_port" type="text" class="form-control {{ $errors->has('smtp_port') ? 'is-invalid' : '' }}" name="smtp_port" value="{{ old('smtp_port', $smtp_port) }}" autocomplete="off" />
                            @if ($errors->has('smtp_port'))
                                <div class="invalid-feedback">{{ $errors->first('smtp_port') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <input id="smtp_user" type="text" class="form-control {{ $errors->has('smtp_user') ? 'is-invalid' : '' }}" name="smtp_user" value="{{ old('smtp_user', $smtp_user) }}" autocomplete="off" />
                            @if ($errors->has('smtp_user'))
                                <div class="invalid-feedback">{{ $errors->first('smtp_user') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input id="smtp_password" type="text" class="form-control {{ $errors->has('smtp_password') ? 'is-invalid' : '' }}" name="smtp_password" value="{{ old('smtp_password', $smtp_password) }}" autocomplete="off" />
                            @if ($errors->has('smtp_password'))
                                <div class="invalid-feedback">{{ $errors->first('smtp_password') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="setup-group">
                        <h5 class="setup-group-title">Transport Security</h5>
                        <div class="form-group">
                            <label class="setup-info-label">
                                TLS
                                <button type="button" class="setup-info-tip" data-toggle="tooltip" title="Keep TLS enabled unless your SMTP provider specifically requires plaintext SMTP.">?</button>
                            </label>
                            <select id="smtp_tls" class="form-control {{ $errors->has('smtp_tls') ? 'is-invalid' : '' }}" name="smtp_tls">
                                <option value="1" {{ (string) old('smtp_tls', $smtp_tls) === '1' ? 'selected' : '' }}>On</option>
                                <option value="0" {{ (string) old('smtp_tls', $smtp_tls) === '0' ? 'selected' : '' }}>Off</option>
                            </select>
                            <span class="smtp-note">Enable TLS unless your mail provider explicitly requires plain SMTP.</span>
                            @if ($errors->has('smtp_tls'))
                                <div class="invalid-feedback">{{ $errors->first('smtp_tls') }}</div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="smtp-actions">
                        <a href="/setup/payments" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary" data-loading-text="Testing mail settings...">Save & Continue</button>
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
