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

    @if(Session::has('message'))
    <div class="alert setup-alert alert-{{ Session::get('type', 'info') }}" role="alert">
        {{ Session::get('message') }}
    </div>
    @endif

    @yield('content')
</div>
</body>
</html>
