@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Setup SMTP details for emails</p>
        <form method="POST">
            <div class="form-group">
                <label>Host</label>

                <div class="form-controls">
                    <input id="smtp_host" type="text" class="form-control" name="smtp_host" value="{{$smtp_host}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>User</label>

                <div class="form-controls">
                    <input id="smtp_user" type="text" class="form-control" name="smtp_user" value="{{$smtp_user}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>

                <div class="form-controls">
                    <input id="smtp_password" type="text" class="form-control" name="smtp_password" value="{{$smtp_password}}"/>
                </div>
            </div>
            <div class="form-group">
                <label>TLS</label>

                <div class="form-controls">
                    <select id="smtp_tls" type="text" class="form-control" name="smtp_tls">
                            <option value="1" selected>On</option>
                            <option value="0">Off</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Save</button>
        </form>
    </div>
    </div>
</div>
@endsection