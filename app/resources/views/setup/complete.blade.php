@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Thanks, Lineblocs is setup!</p>
        <a href="/auth/login" class="btn btn-secondary">Login to Admin</a>
    </div>
    </div>
</div>
@endsection