@extends('layouts.setup')
@section('title') TTS Setup :: @parent @endsection
@section('setup_step', 2)
@section('content')
<div class="tts-wrap">
    <div class="tts-card">
        <div class="tts-head">
            <span class="setup-kicker">Step 2</span>
            <h1 class="tts-title">Configure text-to-speech</h1>
            <p class="tts-subtitle">
                Connect your speech provider so call flows can generate natural prompts and dynamic responses.
            </p>
        </div>

        <div class="tts-alert">
            Use a service account with only the permissions required for text-to-speech generation.
        </div>

        <div class="tts-grid">
            <div class="tts-pane">
                <h4>Provider Credentials</h4>
                <form method="POST" data-setup-form>
                    <div class="setup-group">
                        <h5 class="setup-group-title">Provider</h5>
                        <div class="form-group">
                            <label>Select Provider</label>
                            <select class="form-control {{ $errors->has('tts_provider') ? 'is-invalid' : '' }}" name="tts_provider">
                                <option value="aws" {{ old('tts_provider', $tts_provider) == 'aws' ? 'selected' : '' }}>Google Cloud Text-to-Speech</option>
                            </select>
                            @if ($errors->has('tts_provider'))
                                <div class="invalid-feedback">{{ $errors->first('tts_provider') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="setup-group">
                        <h5 class="setup-group-title">Authentication</h5>
                        <div class="form-group">
                            <label class="setup-info-label">
                                Google Service Account JSON
                                <button type="button" class="setup-info-tip" data-toggle="tooltip" title="This JSON should include keys like client_email and private_key.">?</button>
                            </label>
                            <textarea class="form-control tts-json {{ $errors->has('google_service_account_json') ? 'is-invalid' : '' }}" name="google_service_account_json" autocomplete="off" required>{{ old('google_service_account_json', $google_service_account_json) }}</textarea>
                            <span class="tts-note">Paste the full JSON key content exactly as downloaded from Google Cloud.</span>
                            @if ($errors->has('google_service_account_json'))
                                <div class="invalid-feedback">{{ $errors->first('google_service_account_json') }}</div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="tts-actions">
                        <a href="/setup/storage" class="btn btn-setup-link">Back</a>
                        <button type="submit" class="btn btn-setup-primary" data-loading-text="Checking TTS credentials...">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="tts-pane">
                <h4>What this enables</h4>
                <ul class="tts-points">
                    <li>Generate spoken prompts dynamically for IVR and call flows.</li>
                    <li>Support multilingual and natural-sounding voice playback.</li>
                    <li>Keep prompts centralized and easy to update without re-recording.</li>
                    <li>Prepare your platform for AI and automation voice experiences.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
