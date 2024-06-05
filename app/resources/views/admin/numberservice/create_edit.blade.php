@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($numberservice))
{!! Form::model($numberservice, array('url' => url('admin/numberservice') . '/' . $numberservice->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/numberservice'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <h2>Provider details</h2>
        <hr/>
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/numberservices.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('key_name') ? 'has-error' : '' }}">
            {!! Form::label('key_name', trans("admin/numberservices.key_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('key_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('key_name', ':message') }}</span>
            </div>
        </div>

        <h2>API settings</h2>
        <hr/>
        <div class="form-group  {{ $errors->has('api_key') ? 'has-error' : '' }}">
            {!! Form::label('api_key', trans("admin/numberservices.api_key"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_key', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_key', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('api_secret') ? 'has-error' : '' }}">
            {!! Form::label('api_secret', trans("admin/numberservices.api_secret"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_secret', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_secret', ':message') }}</span>
            </div>
        </div>

    
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($numberservice))
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
