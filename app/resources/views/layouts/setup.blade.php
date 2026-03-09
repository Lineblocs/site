<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lineblocs setup</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('css/setup-redesign.css') }}" rel="stylesheet">
</head>
<body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php
    $currentStepRaw = trim($__env->yieldContent('setup_step'));
    $currentStep = is_numeric($currentStepRaw) ? (int) $currentStepRaw : 0;
    $setupSteps = array(
        1 => 'Storage',
        2 => 'TTS',
        3 => 'Payments',
        4 => 'SMTP',
        5 => 'Admin',
        6 => 'Branding',
        7 => 'Complete'
    );
?>

<div class="setup-shell">
    <div class="setup-topbar">
        <div class="setup-brand">
            <img src="{{ url('img/lineblocs-setup.png') }}" width="52" alt="Lineblocs setup logo" />
            <div>
                <p class="setup-brand-subtitle">Lineblocs Wizard</p>
                <h2 class="setup-brand-title">Setup</h2>
            </div>
        </div>
        <span class="setup-pill">Installation Flow</span>
    </div>

    <div class="setup-stepper" role="navigation" aria-label="Setup progress">
        @foreach($setupSteps as $index => $label)
            <?php
                $statusClass = 'upcoming';
                if ($currentStep >= $index && $currentStep > 0) {
                    $statusClass = $currentStep == $index ? 'active' : 'done';
                }
            ?>
            <div class="setup-step {{ $statusClass }}">
                <span class="setup-step-dot">{{ $index }}</span>
                <span class="setup-step-label">{{ $label }}</span>
            </div>
        @endforeach
    </div>

    @if(Session::has('message'))
    <div class="alert setup-alert setup-alert-{{ Session::get('type', 'info') }} alert-{{ Session::get('type', 'info') }}" role="alert">
        {{ Session::get('message') }}
    </div>
    @endif

    @yield('content')
</div>
<script>
    (function () {
        if (window.jQuery && $.fn.tooltip) {
            $('[data-toggle="tooltip"]').tooltip();
        }

        function showLoadingState(form) {
            var submitButtons = form.querySelectorAll('button[type="submit"]');
            for (var i = 0; i < submitButtons.length; i++) {
                var button = submitButtons[i];
                button.disabled = true;
                if (!button.getAttribute('data-original-label')) {
                    button.setAttribute('data-original-label', button.textContent);
                }
                var loadingLabel = button.getAttribute('data-loading-text') || 'Saving...';
                button.innerHTML = '<span class="setup-btn-spinner" aria-hidden="true"></span>' + loadingLabel;
            }
            form.classList.add('setup-form-submitting');
        }

        var forms = document.querySelectorAll('form[data-setup-form]');
        for (var i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', function (event) {
                if (this.checkValidity && !this.checkValidity()) {
                    return;
                }
                showLoadingState(this);
            });
        }
    })();
</script>
</body>
</html>
