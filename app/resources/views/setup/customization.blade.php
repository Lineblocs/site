@extends('layouts.setup')
@section('title') Customization Setup :: @parent @endsection
@section('setup_step', 6)
@section('content')
<div class="customization-wrap">
    <div class="customization-card">
        <div class="customization-head">
            <span class="setup-kicker">Step 6</span>
            <h1 class="customization-title">Customize your workspace branding</h1>
            <p class="customization-subtitle">
                Define your company display name to personalize your setup and admin-facing experience.
            </p>
        </div>

        <div class="customization-alert">
            Use the business name your team and customers recognize in day-to-day communication.
        </div>

        <div class="customization-grid">
            <div class="customization-pane">
                <h4>Branding Details</h4>
                <form method="POST" data-setup-form>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name', $name) }}" required />
                        <span class="customization-note">You can refine additional branding options later from platform settings.</span>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="customization-actions">
                        <a href="/setup/admin" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary" data-loading-text="Finalizing branding...">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="customization-pane">
                <h4>What this enables</h4>
                <ul class="customization-points">
                    <li>Sets your organization display identity in setup screens.</li>
                    <li>Creates a clearer admin context for future team members.</li>
                    <li>Improves consistency across dashboard and account messaging.</li>
                    <li>Prepares the final step before setup completion.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
