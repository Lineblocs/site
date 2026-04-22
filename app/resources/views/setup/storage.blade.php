@extends('layouts.setup')
@section('title') Storage Setup :: @parent @endsection
@section('setup_step', 1)
@section('content')
<style>
    .storage-wrap {
        max-width: 980px;
        margin: 34px auto;
        padding: 0 14px 24px;
    }

    .storage-card {
        background: linear-gradient(150deg, #f7fcfb 0%, #ffffff 52%, #eff6fb 100%);
        border: 1px solid #dce8f1;
        border-radius: 18px;
        box-shadow: 0 16px 44px rgba(17, 42, 60, 0.12);
        overflow: hidden;
    }

    .storage-head {
        padding: 24px 24px 8px;
    }

    .storage-kicker {
        display: inline-block;
        background: #e5f4f1;
        color: #0e6f65;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 6px 10px;
        margin-bottom: 10px;
    }

    .storage-title {
        margin: 0 0 10px;
        color: #17344e;
        font-size: 30px;
        font-weight: 700;
        line-height: 1.2;
    }

    .storage-subtitle {
        margin: 0;
        color: #4b647c;
        font-size: 15px;
        line-height: 1.65;
    }

    .storage-alert {
        margin: 16px 24px 0;
        background: #eef6ff;
        border: 1px solid #cfe3fb;
        color: #244968;
        border-radius: 12px;
        padding: 11px 13px;
        font-size: 14px;
        line-height: 1.5;
    }

    .storage-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 14px;
        padding: 18px 24px 24px;
    }

    .storage-form-pane,
    .storage-info-pane {
        background: #ffffff;
        border: 1px solid #dbe8f1;
        border-radius: 14px;
        padding: 18px;
    }

    .storage-form-pane h4,
    .storage-info-pane h4 {
        margin: 0 0 14px;
        color: #1f3f5d;
        font-size: 16px;
        font-weight: 700;
    }

    .form-group label {
        color: #2e4f6e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .form-control {
        border-radius: 10px;
        border-color: #cfdce7;
        min-height: 44px;
    }

    .form-control:focus {
        border-color: #0f7d72;
        box-shadow: 0 0 0 3px rgba(15, 125, 114, 0.14);
    }

    .field-note {
        display: block;
        margin-top: 6px;
        color: #6a8197;
        font-size: 12px;
    }

    .storage-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .storage-list li {
        border-bottom: 1px solid #edf2f7;
        padding: 10px 0;
        color: #425a70;
        font-size: 14px;
        line-height: 1.55;
    }

    .storage-list li:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .storage-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 4px;
    }

    .btn-storage-primary {
        background: linear-gradient(130deg, #12877d, #0f6d63);
        border: 0;
        color: #fff;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 700;
        padding: 11px 18px;
    }

    .btn-storage-primary:hover,
    .btn-storage-primary:focus {
        color: #fff;
        text-decoration: none;
        background: linear-gradient(130deg, #107c72, #0d5e56);
    }

    .btn-storage-secondary {
        background: #eef3f9;
        color: #35506b;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 700;
        padding: 11px 18px;
    }

    .btn-storage-secondary:hover,
    .btn-storage-secondary:focus {
        color: #243d56;
        text-decoration: none;
        background: #e2ebf4;
    }

    @media (max-width: 860px) {
        .storage-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .storage-head {
            padding: 20px 18px 8px;
        }

        .storage-alert {
            margin: 14px 18px 0;
        }

        .storage-grid {
            padding: 14px 18px 18px;
        }

        .storage-title {
            font-size: 26px;
        }
    }
</style>

<div class="storage-wrap">
    <div class="storage-card">
        <div class="storage-head">
            <span class="storage-kicker">Step 1</span>
            <h1 class="storage-title">Configure media storage</h1>
            <p class="storage-subtitle">
                Choose where recordings, generated speech, and customer-uploaded media files are stored.
                This connection is required before setup can continue.
            </p>
        </div>

        <div class="storage-alert">
            Use a dedicated bucket and least-privilege IAM credentials for better security and cleaner billing visibility.
        </div>

        <div class="storage-grid">
            <div class="storage-form-pane">
                <h4>Storage Credentials</h4>
                <form method="POST" data-setup-form>
                    <div class="setup-group">
                        <h5 class="setup-group-title">Provider</h5>
                        <div class="form-group">
                            <label>Storage Provider</label>
                            <select class="form-control {{ $errors->has('storage_provider') ? 'is-invalid' : '' }}" name="storage_provider">
                                <option value="aws" {{ old('storage_provider', $storage_provider) == 'aws' ? 'selected' : '' }}>Amazon S3</option>
                            </select>
                            @if ($errors->has('storage_provider'))
                                <div class="invalid-feedback">{{ $errors->first('storage_provider') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="setup-group">
                        <h5 class="setup-group-title">Access Credentials</h5>
                        <div class="form-group">
                            <label>AWS Access Key ID</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('aws_access_key_id') ? 'is-invalid' : '' }}"
                                name="aws_access_key_id"
                                value="{{ old('aws_access_key_id', $aws_access_key_id) }}"
                                autocomplete="off"
                            />
                            <span class="field-note">Key should allow read/write access for your storage bucket.</span>
                            @if ($errors->has('aws_access_key_id'))
                                <div class="invalid-feedback">{{ $errors->first('aws_access_key_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>AWS Secret Access Key</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('aws_secret_access_key') ? 'is-invalid' : '' }}"
                                name="aws_secret_access_key"
                                value="{{ old('aws_secret_access_key', $aws_secret_access_key) }}"
                                autocomplete="off"
                            />
                            @if ($errors->has('aws_secret_access_key'))
                                <div class="invalid-feedback">{{ $errors->first('aws_secret_access_key') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="setup-info-label">
                                AWS Region
                                <button type="button" class="setup-info-tip" data-toggle="tooltip" title="Use the region closest to your telephony servers to reduce media latency.">?</button>
                            </label>
                            <select class="form-control {{ $errors->has('aws_region') ? 'is-invalid' : '' }}" name="aws_region" id="aws_region">
                                @foreach ($aws_regions as $key => $region)
                                    <option value="{{ $key }}" {{ $key == old('aws_region', $selected_region) ? 'selected' : '' }}>
                                        {{ $region }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('aws_region'))
                                <div class="invalid-feedback">{{ $errors->first('aws_region') }}</div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="storage-actions">
                        <a href="/setup" class="btn btn-storage-secondary">Back</a>
                        <button type="submit" class="btn btn-storage-primary" data-loading-text="Validating storage...">Save & Continue</button>
                    </div>
                </form>
            </div>

            <div class="storage-info-pane">
                <h4>What this powers</h4>
                <ul class="storage-list">
                    <li>Recording archives for call history and compliance.</li>
                    <li>Generated audio from text-to-speech prompts.</li>
                    <li>Uploaded files used by call flows and IVR menus.</li>
                    <li>Centralized media access for customer workspaces.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
