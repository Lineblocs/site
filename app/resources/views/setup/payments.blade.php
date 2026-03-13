@extends('layouts.setup')
@section('title') Payments Setup :: @parent @endsection
@section('setup_step', 3)
@section('content')
<div class="payments-wrap">
    <div class="payments-card">
        <div class="payments-head">
            <span class="setup-kicker">Step 3</span>
            <h1 class="payments-title">Configure Stripe billing</h1>
            <p class="payments-subtitle">
                Add your Stripe API credentials so your platform can collect payments and manage billing events.
            </p>
        </div>

        <div class="payments-alert">
            Keep test and live keys separate to avoid charging real customers during sandbox validation.
        </div>

        <div class="payments-grid">
            <div class="payments-pane">
                <h4>Stripe API Keys</h4>
                <form method="POST" data-setup-form>
                    <div class="setup-group">
                        <h5 class="setup-group-title">Live Keys</h5>
                        <div class="form-group">
                            <label>Stripe Private Key</label>
                            <input id="stripe_private_key" type="text" class="form-control {{ $errors->has('stripe_private_key') ? 'is-invalid' : '' }}" name="stripe_private_key" value="{{ old('stripe_private_key', $stripe_private_key) }}" autocomplete="off" />
                            @if ($errors->has('stripe_private_key'))
                                <div class="invalid-feedback">{{ $errors->first('stripe_private_key') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Stripe Publishable Key</label>
                            <input id="stripe_pub_key" type="text" class="form-control {{ $errors->has('stripe_pub_key') ? 'is-invalid' : '' }}" name="stripe_pub_key" value="{{ old('stripe_pub_key', $stripe_pub_key) }}" autocomplete="off" />
                            @if ($errors->has('stripe_pub_key'))
                                <div class="invalid-feedback">{{ $errors->first('stripe_pub_key') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="setup-group">
                        <h5 class="setup-group-title">Test Keys</h5>
                        <div class="form-group">
                            <label>Stripe Test Private Key</label>
                            <input id="stripe_test_private_key" type="text" class="form-control {{ $errors->has('stripe_test_private_key') ? 'is-invalid' : '' }}" name="stripe_test_private_key" value="{{ old('stripe_test_private_key', $stripe_test_private_key) }}" autocomplete="off" />
                            @if ($errors->has('stripe_test_private_key'))
                                <div class="invalid-feedback">{{ $errors->first('stripe_test_private_key') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Stripe Test Publishable Key</label>
                            <input id="stripe_test_pub_key" type="text" class="form-control {{ $errors->has('stripe_test_pub_key') ? 'is-invalid' : '' }}" name="stripe_test_pub_key" value="{{ old('stripe_test_pub_key', $stripe_test_pub_key) }}" autocomplete="off" />
                            <span class="payments-note">Use keys from your Stripe dashboard for both live and test environments.</span>
                            @if ($errors->has('stripe_test_pub_key'))
                                <div class="invalid-feedback">{{ $errors->first('stripe_test_pub_key') }}</div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="payments-actions">
                        <a href="/setup/tts" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary" data-loading-text="Validating Stripe keys...">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="payments-pane">
                <h4>What this enables</h4>
                <ul class="payments-points">
                    <li>Create and process customer payments through Stripe.</li>
                    <li>Support subscriptions, plan upgrades, and account billing updates.</li>
                    <li>Use test keys for safe staging and QA validation.</li>
                    <li>Prepare your setup for production-ready revenue workflows.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
