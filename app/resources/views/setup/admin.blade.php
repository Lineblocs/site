@extends('layouts.setup')
@section('title') Home :: @parent @endsection
@section('content')
<div class="main">
    <div class="col-md-12">
    <div class="setup-form">
        <p>Create admin user</p>
        <form method="POST">
            <div class="form-group">
                <label>Email</label>

                <div class="form-controls">
                    <input id="email" type="email" class="form-control" name="email" value="{{$email}}" required/>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>

                <div class="form-controls">
                    <input id="admin_password" type="text" class="form-control" name="admin_password" value="" required/>
                </div>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>

                <div class="form-controls">
                    <input id="admin_cpassword" type="text" class="form-control" name="admin_cpassword" value="" required/>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button type="submit" class="btn btn-secondary">Save</button>
        </form>
    </div>
    </div>
</div>
@endsection