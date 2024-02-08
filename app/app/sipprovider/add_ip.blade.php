@extends('admin.layouts.modal', ['backLocation' => url('admin/provider/' . $provider->id. '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($ip))
{!! Form::model($ip, array('url' => url('admin/provider/' . $provider->id . '/edit_ip/' . $ip->id), 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/provider/' . $provider->id . '/add_ip'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('ip_address') ? 'has-error' : '' }}">
            {!! Form::label('ip_address', trans("admin/sipips.ip_address"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('ip_address', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('ip_address', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('range') ? 'has-error' : '' }}">
            {!! Form::label('range', trans("admin/sipips.range"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('range', $ranges, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('range', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($ip))
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