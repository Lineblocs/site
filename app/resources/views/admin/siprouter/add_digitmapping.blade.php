@extends('admin.layouts.modal', ['backLocation' => url('admin/router/' . $router->id. '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($digitMapping))
{!! Form::model($digitMapping, array('url' => url('admin/router/' . $router->id . '/edit_digitmapping/' . $digitMapping->id), 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/router/' . $router->id . '/add_digitmapping'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">

        <div class="form-group  {{ $errors->has('ani') ? 'has-error' : '' }}">
            {!! Form::label('ani', trans("admin/siprouters.ani"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('ani', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('ani', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('route1') ? 'has-error' : '' }}">
            {!! form::label('route1', trans("admin/siprouters.route1"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('route1', $providers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('route1', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('route2') ? 'has-error' : '' }}">
            {!! form::label('route2', trans("admin/siprouters.route2"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('route2', $providers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('route2', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('route3') ? 'has-error' : '' }}">
            {!! form::label('route3', trans("admin/siprouters.route3"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('route3', $providers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('route3', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('route4') ? 'has-error' : '' }}">
            {!! form::label('route4', trans("admin/siprouters.route4"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('route4', $providers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('route4', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('route5') ? 'has-error' : '' }}">
            {!! form::label('route5', trans("admin/siprouters.route5"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! form::select('route5', $providers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('route5', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($digitMapping))
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