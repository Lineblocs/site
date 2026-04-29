<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PayPal Billing Agreement</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2d3d;
        }
        .page {
            max-width: 760px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 12px 30px rgba(31, 45, 61, 0.08);
        }
        h1 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 30px;
        }
        p {
            line-height: 1.6;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            margin-bottom: 18px;
        }
        .button {
            border: 0;
            border-radius: 999px;
            background: #ffc439;
            color: #111;
            font-weight: bold;
            font-size: 16px;
            padding: 14px 24px;
            cursor: pointer;
        }
        .button[disabled] {
            opacity: 0.7;
            cursor: wait;
        }
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
        }
        .success {
            background: #edf9f0;
            color: #166534;
        }
        .error {
            background: #fff1f0;
            color: #b42318;
        }
        .result {
            margin-top: 22px;
            padding: 18px;
            background: #f8fafc;
            border-radius: 10px;
        }
        .muted {
            color: #5b6b7f;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>PayPal Billing Agreement</h1>
            <p>This is a standalone PayPal billing page. It creates the plan in the backend and then sends the user to PayPal to approve the billing agreement.</p>

            @if(session('paypal_agreement_success'))
                <div class="alert success">{{ session('paypal_agreement_success') }}</div>
            @endif

            @if(session('paypal_agreement_error'))
                <div class="alert error">{{ session('paypal_agreement_error') }}</div>
            @endif

            <button id="create-agreement" class="button">Connect PayPal</button>

            <p class="muted">This page uses a single button. The backend creates an active recurring plan automatically before creating the agreement.</p>

            @if($lastAgreement)
                <div class="result">
                    <p><strong>Last agreement ID:</strong> {{ $lastAgreement['agreement_id'] }}</p>
                    <p><strong>Status:</strong> {{ $lastAgreement['state'] }}</p>
                    <p><strong>Payer email:</strong> {{ $lastAgreement['payer_email'] }}</p>
                    <p><strong>Plan ID:</strong> {{ $lastAgreement['plan_id'] }}</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        (function () {
            var button = document.getElementById('create-agreement');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            button.addEventListener('click', function () {
                button.disabled = true;
                button.textContent = 'Redirecting to PayPal...';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ url("portal/paypal-billing-agreement/create") }}', true);
                xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState !== 4) {
                        return;
                    }

                    var payload = {};
                    try {
                        payload = JSON.parse(xhr.responseText || '{}');
                    } catch (e) {
                        payload = {};
                    }

                    if (xhr.status >= 200 && xhr.status < 300 && payload.approval_url) {
                        window.location.href = payload.approval_url;
                        return;
                    }

                    button.disabled = false;
                    button.textContent = 'Create Sandbox Billing Agreement';
                    window.alert(payload.error || 'Could not create the PayPal billing agreement.');
                };

                xhr.send(JSON.stringify({}));
            });
        })();
    </script>
</body>
</html>
