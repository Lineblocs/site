@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($serviceplan))
{!! Form::model($serviceplan, array('url' => url('admin/serviceplan') . '/' . $serviceplan->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/serviceplan'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('key_name') ? 'has-error' : '' }}">
            {!! Form::label('key_name', trans("admin/serviceplans.key_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('key_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('nice_name') ? 'has-error' : '' }}">
            {!! Form::label('nice_name', trans("admin/serviceplans.nice_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('nice_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('monthly_charge_cents') ? 'has-error' : '' }}">
            {!! Form::label('base_costs', trans("admin/serviceplans.monthly_charge_cents"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('base_costs', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('annual_cost_cents') ? 'has-error' : '' }}">
            {!! Form::label('annual_cost_cents', trans("admin/serviceplans.annual_cost_cents"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('annual_cost_cents', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('rank') ? 'has-error' : '' }}">
            {!! Form::label('rank', trans("admin/serviceplans.rank"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('rank', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('call_duration') ? 'has-error' : '' }}">
            {!! Form::label('call_duration', trans("admin/serviceplans.call_duration"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('call_duration', $callDurations, NULL, ['id' => 'callduration', 'class' => 'form-control']) !!}

                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('recording_space') ? 'has-error' : '' }}">
            {!! Form::label('recording_space', trans("admin/serviceplans.recording_space"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('recording_space', $recordingSpace, NULL, ['id' => 'recordingspace', 'class' => 'form-control']) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        @foreach ( $features as $feature )
            <div class="form-group  {{ $errors->has($feature['key']) ? 'has-error' : '' }}">
                {!! form::label($feature['key'], trans("admin/serviceplans." . $feature['key']), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! form::label($feature['key'], trans("admin/users.yes"), array('class' => 'control-label')) !!}
                    {!! form::radio($feature['key'], '1', @isset($serviceplan)? $serviceplan->{$feature['key']} : 'false') !!}
                    {!! form::label($feature['key'], trans("admin/users.no"), array('class' => 'control-label')) !!}
                    {!! form::radio($feature['key'], '0', @isset($serviceplan)? $serviceplan->{$feature['key']} : 'true') !!}
                    <span class="help-block">{{ $errors->first($feature['key'], ':message') }}</span>
                </div>
            </div>
        @endforeach
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($serviceplan))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
    {!! Form::close() !!}
    @endsection @section('scripts')

        <script type="text/javascript">
        </script>
</div>
@endsection
