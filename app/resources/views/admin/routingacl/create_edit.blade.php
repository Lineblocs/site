@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($routingacl))
{!! Form::model($routingacl, array('url' => url('admin/routingacl') . '/' . $routingacl->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/routingacl'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('iso') ? 'has-error' : '' }}">
            {!! Form::label('iso', trans("admin/routingacl.iso"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('iso', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/routingacl.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('risk_level') ? 'has-error' : '' }}">
            {!! Form::label('risk_level', trans("admin/routingacl.risk_level"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('risk_level', $riskLevels, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('risk_level', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
            {!! Form::label('enabled', trans("admin/admin.enabled"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('enabled', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '1', @isset($user)? $user->enabled : 'false') !!}
                {!! Form::label('enabled', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '0', @isset($user)? $user->enabled : 'true') !!}
                <span class="help-block">{{ $errors->first('enabled', ':message') }}</span>
            </div>
        </div>



        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($routingacl))
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
