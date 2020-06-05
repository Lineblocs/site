@extends('admin.layouts.modal', ['backLocation' => url('admin/router/' . $router->id. '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($server))
{!! Form::model($server, array('url' => url('admin/router/' . $router->id . '/edit_server/' . $server->id), 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/router/' . $router->id . '/add_server'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">

        <div class="form-group  {{ $errors->has('server_id') ? 'has-error' : '' }}">
            {!! Form::label('server_id', trans("admin/siprouters.server"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('server_id', $servers, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('server_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($server))
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