@extends('layouts.app')

{{-- Web site Title --}}
@section('title') {!!  trans('site/user.login') !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="page-header">
            <h2>{!! trans('site/user.login_to_account') !!}</h2>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            {!! Form::open(array('url' => url('/auth/login'), 'method' => 'post', 'files'=> true)) !!}
            <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', "E-Mail Address", array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('email', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', "Password", array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                    <a href="{{ url('/password/email') }}">Forgot Your Password?</a>
                </div>
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                      Login
                  </button>
                  <br/>
                  <input type="checkbox" name="remember"> Remember Me
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
