@extends('admin.layouts.modal', ['backLocation' => url('admin/provider/' . $provider->id. '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($host))
{!! Form::model($host, array('url' => url('admin/provider/' . $provider->id . '/edit_host/' . $host->id), 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/provider/' . $provider->id . '/add_host'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/siphosts.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('ip_address') ? 'has-error' : '' }}">
            {!! Form::label('ip_address', trans("admin/siphosts.ip_address"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('ip_address', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('ip_address', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority_prefixes') ? 'has-error' : '' }}">
            {!! Form::label('priority_prefixes', trans("admin/siphosts.priority_prefixes"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('priority_prefixes', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('priority_prefixes', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority') ? 'has-error' : '' }}">
            {!! Form::label('priority', trans("admin/siphosts.priority"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('priority', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($host))
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