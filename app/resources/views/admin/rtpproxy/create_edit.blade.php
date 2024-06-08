@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

</ul>
<!-- ./ tabs -->
@if (isset($rtpproxy))
{!! Form::model($rtpproxy, array('url' => url('admin/rtpproxy') . '/' . $rtpproxy->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/rtpproxy'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('rtpproxy_sock') ? 'has-error' : '' }}">
            {!! Form::label('rtpproxy_sock', trans("admin/rtpproxies.rtpproxy_sock"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('rtpproxy_sock', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('rtpproxy_sock', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('ip_address') ? 'has-error' : '' }}">
            {!! Form::label('ip_address', trans("admin/rtpproxies.ip_address"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('ip_address', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('ip_address', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  no-padding {{ $errors->has('set_id') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('set_id', trans("admin/rtpproxies.set_id"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('set_id', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('set_id', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('priority', trans("admin/rtpproxies.priority"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('priority', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                </div>
            </div>

        </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('router_id', trans("admin/rtpproxies.router"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('router_id', $routers, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('router', ':message') }}</span>
                </div>
        </div>
        <div class="form-group  {{ $errors->has('on_same_network_as_router') ? 'has-error' : '' }}">
            {!! Form::label('on_same_network_as_router', trans("admin/rtpproxies.on_same_network_as_router"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('on_same_network_as_router', trans("admin/users.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('on_same_network_as_router', '1', @isset($rtpproxy)? $rtpproxy->on_same_network_as_router : 'false') !!}
                {!! Form::label('on_same_network_as_router', trans("admin/users.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('on_same_network_as_router', '0', @isset($rtpproxy)? $rtpproxy->on_same_network_as_router : 'true') !!}
                <span class="help-block">{{ $errors->first('on_same_network_as_router', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($rtpproxy))
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
                @if (!empty($rtpproxy))
                    var serverId = "{{$rtpproxy->id}}";
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
                        $.post("/admin/rtpproxy/" + serverId + "/del_host/" + id, params, function() {
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
                        $.post("/admin/rtpproxy/" + serverId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
