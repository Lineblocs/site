@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($provider))
{!! Form::model($provider, array('url' => url('admin/provider') . '/' . $provider->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/provider'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/sipproviders.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('api_name') ? 'has-error' : '' }}">
            {!! Form::label('api_name', trans("admin/sipproviders.api_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('tags') ? 'has-error' : '' }}">
            {!! Form::label('tags', trans("admin/sipproviders.tags"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('tags', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('tags', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('country') ? 'has-error' : '' }}">
            {!! Form::label('country', trans("admin/sipproviders.country"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('country', $countries, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('country', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('dial_prefix') ? 'has-error' : '' }}">
            {!! Form::label('dial_prefix', trans("admin/sipproviders.dial_prefix"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('dial_prefix', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('dial_prefix', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority') ? 'has-error' : '' }}">
            {!! Form::label('priority', trans("admin/sipproviders.priority"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('priority', null, array('class' => 'form-control', 'min' => '1', 'max' => '10')) !!}
                <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('host') ? 'has-error' : '' }}">
            {!! Form::label('host', trans("admin/sipproviders.host"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('host', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('host', ':message') }}</span>
            </div>
        </div>





        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/sipproviders.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($provider)? $provider->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($provider)? $provider->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($provider))
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
            $(function () {
                $("#roles").select2()
            });
        </script>
</div>
@endsection
