@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
{!! Form::model($port, array('url' => url('admin/user') . '/' . $user->id .  '/port/' . $port->id . '/edit', 'method' => 'put', 'class' => 'bf', 'close' => 'no', 'next' => '/admin/user/' . $user->id . '/edit', 'files'=> true)) !!}
 
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('number', trans("admin/users.number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('number', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('provider') ? 'has-error' : '' }}">
            {!! Form::label('provider', trans("admin/users.provider"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('provider', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('provider', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
            {!! Form::label('status', trans("admin/users.status"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('status', $statuses, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('state', ':message') }}</span>
            </div>
        </div>
        <div id="eta" class="form-group  {{ $errors->has('eta') ? 'has-error' : '' }} dont-show">
            {!! Form::label('eta', trans("admin/users.eta"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::date('eta', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('date', ':message') }}</span>
            </div>
        </div>
        <div id="infoNeeded" class="form-group  {{ $errors->has('info_needed') ? 'has-error' : '' }} dont-show">
            {!! Form::label('info_needed', trans("admin/users.info_needed"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::textarea('info_needed', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('info_needed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($user))
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
            $("#status").on("change", function() {
                var val = $( this ).val();
                console.log("status is now ", val);
                if (val === 'confirmed') {
                    $("#eta").show();
                    $("#infoNeeded").hide();
                } else if (val === 'needs-info') {
                    $("#eta").hide();
                    $("#infoNeeded").show();
                }
            })
        </script>
</div>
@endsection
