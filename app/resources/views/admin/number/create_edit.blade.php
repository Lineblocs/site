@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

</ul>
<!-- ./ tabs -->
@if (isset($number))
{!! Form::model($number, array('url' => url('admin/number') . '/' . $number->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/number'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('number') ? 'has-error' : '' }}">
            {!! Form::label('number', trans("admin/numbers.number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('api_number') ? 'has-error' : '' }}">
            {!! Form::label('api_number', trans("admin/numbers.api_number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('country') ? 'has-error' : '' }}">
            {!! Form::label('country', trans("admin/numbers.country"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('country', $countries, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('country', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('region') ? 'has-error' : '' }}">
            {!! Form::label('region', trans("admin/numbers.region"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('region', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('region', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('monthly_cost') ? 'has-error' : '' }}">
            {!! Form::label('monthly_cost', trans("admin/numbers.monthly_cost"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('monthly_cost', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('monthly_cost', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('setup_cost') ? 'has-error' : '' }}">
            {!! Form::label('setup_cost', trans("admin/numbers.setup_cost"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('setup_cost', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('setup_cost', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('routed_server') ? 'has-error' : '' }}">
            {!! Form::label('routed_server', trans("admin/numbers.routed_server"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('routed_server', $routers, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('routed_server', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('provider_id') ? 'has-error' : '' }}">

            {!! Form::label('provider_id', trans("admin/numbers.provider"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('provider_id', $providers, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('provider_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($number))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
@endsection
