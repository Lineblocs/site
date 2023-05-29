@extends('admin.layouts.modal', ['backLocation' => url('admin/provider/' . $provider->id. '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($rate))
{!! Form::model($rate, array('url' => url('admin/provider/' . $provider->id . '/edit_rate/' . $rate->id), 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/provider/' . $provider->id . '/add_rate'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('rate') ? 'has-error' : '' }}">
            {!! Form::label('rate', trans("admin/siprates.rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('rate', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('rate', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('rate_ref_id') ? 'has-error' : '' }}">
            {!! Form::label('rate_ref_id', trans("admin/siprates.rate_ref_id"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('rate_ref_id', $rates, null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('rate_ref_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority') ? 'has-error' : '' }}">
            {!! Form::label('priority', trans("admin/siprates.priority"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('priority', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($rate))
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