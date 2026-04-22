@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

</ul>
<!-- ./ tabs -->
@if (isset($rtpengine))
{!! Form::model($rtpengine, array('url' => url('admin/rtpengine') . '/' . $rtpengine->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/rtpengine'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('socket') ? 'has-error' : '' }}">
            {!! Form::label('socket', trans("admin/rtpengines.socket"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('socket', null, array('class' => 'form-control', 'placeholder' => 'e.g: udp:127.0.0.1:7722')) !!}
                <span class="help-block">{{ $errors->first('socket', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  no-padding {{ $errors->has('set_id') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('set_id', trans("admin/rtpengines.set_id"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('set_id', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('set_id', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('priority', trans("admin/rtpengines.priority"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('priority', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                </div>
            </div>

        </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('router_id', trans("admin/rtpengines.router"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('router_id', $routers, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('router', ':message') }}</span>
                </div>
        </div>
        <div class="form-group  {{ $errors->has('on_same_network_as_router') ? 'has-error' : '' }}">
            {!! Form::label('on_same_network_as_router', trans("admin/rtpengines.on_same_network_as_router"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('on_same_network_as_router', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('on_same_network_as_router', '1', @isset($rtpengine)? $rtpengine->on_same_network_as_router : 'false') !!}
                {!! Form::label('on_same_network_as_router', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('on_same_network_as_router', '0', @isset($rtpengine)? $rtpengine->on_same_network_as_router : 'true') !!}
                <span class="help-block">{{ $errors->first('on_same_network_as_router', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($rtpengine))
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
                @if (!empty($rtpengine))
                    var serverId = "{{$rtpengine->id}}";
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
                        $.post("/admin/rtpengine/" + serverId + "/del_host/" + id, params, function() {
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
                        $.post("/admin/rtpengine/" + serverId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
