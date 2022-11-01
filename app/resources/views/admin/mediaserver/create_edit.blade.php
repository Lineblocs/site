@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

</ul>
<!-- ./ tabs -->
@if (isset($server))
{!! Form::model($server, array('url' => url('admin/server') . '/' . $server->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/server'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/mediaservers.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  no-padding {{ $errors->has('ip_address') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('ip_address', trans("admin/mediaservers.ip_address"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('ip_address', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('ip_address', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('ip_address_range', trans("admin/mediaservers.ip_address_range"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('ip_address_range', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('ip_address_range', ':message') }}</span>
                </div>
            </div>

        </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('private_ip_address', trans("admin/mediaservers.private_ip_address"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('private_ip_address', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('private_ip_address', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('private_ip_address_range', trans("admin/mediaservers.private_ip_address_range"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('private_ip_address_range', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('private_ip_address_range', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('webrtc_optimized') ? 'has-error' : '' }}">
            {!! Form::label('webrtc_optimized', trans("admin/admin.webrtc_optimized"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('webrtc_optimized', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('webrtc_optimized', '1', @isset($user)? $user->webrtc_optimized : 'false') !!}
                {!! Form::label('webrtc_optimized', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('webrtc_optimized', '0', @isset($user)? $user->webrtc_optimized : 'true') !!}
                <span class="help-block">{{ $errors->first('webrtc_optimized', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($server))
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
                @if (!empty($server))
                    var serverId = "{{$server->id}}";
                @else
                    var serverId = null;
                @endif
                $("#roles").select2()
                $(".del-host").each(function() {
                    $( this ).click(function() {
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/server/" + serverId + "/del_host/" + id, params, function() {
                            alert("Host deleted..");
                            window.location.reload();
                        });
                    });
                });
                $(".del-ip").each(function() {
                    $( this ).click(function() {
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/server/" + serverId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
