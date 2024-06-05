@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (!empty($servers))
     <li><a href="#tab-digitmapping" data-toggle="tab"> {{
            trans("admin/modal.digitmapping") }}</a></li>
            @endif

            @if (!empty($servers))
     <li><a href="#tab-servers" data-toggle="tab"> {{
            trans("admin/modal.servers") }}</a></li>
            @endif
            @if (!empty($rtpproxies))
     <li><a href="#tab-rtpproxies" data-toggle="tab"> {{
            trans("admin/modal.rtpproxies") }}</a></li>
            @endif

</ul>
<!-- ./ tabs -->
@if (isset($router))
{!! Form::model($router, array('url' => url('admin/router') . '/' . $router->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/router'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/siprouters.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  no-padding {{ $errors->has('ip_address') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('ip_address', trans("admin/siprouters.ip_address"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('ip_address', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('ip_address', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('ip_address_range', trans("admin/siprouters.ip_address_range"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('ip_address_range', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('ip_address_range', ':message') }}</span>
                </div>
            </div>

        </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('private_ip_address', trans("admin/siprouters.private_ip_address"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('private_ip_address', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('private_ip_address', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('private_ip_address_range', trans("admin/siprouters.private_ip_address_range"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('private_ip_address_range', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('private_ip_address_range', ':message') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group no-padding {{ $errors->has('region_id') ? 'has-error' : '' }}">
                {!! Form::label('region_id', trans("admin/siprouters.region"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('region_id', $regions, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('region_id', ':message') }}</span>
                </div>
        </div>

        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('udp_support', trans("admin/siprouters.udp_support"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::checkbox('udp_support', "true", $router->udp_support) !!}
                    <span class="help-block">{{ $errors->first('udp_support', ':message') }}</span>
                </div>
     </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('udp_autoscaling', trans("admin/siprouters.udp_autoscaling"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::checkbox('udp_autoscaling', "true", $router->udp_autoscaling) !!}
                    <span class="help-block">{{ $errors->first('udp_autoscaling', ':message') }}</span>
                </div>
     </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                    {!! Form::label('udp_port', trans("admin/siprouters.udp_port"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('udp_port', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('udp_port', ':message') }}</span>
                    </div>
        </div>

        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('tcp_support', trans("admin/siprouters.tcp_support"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::checkbox('tcp_support', "true", $router->tcp_support) !!}
                    <span class="help-block">{{ $errors->first('tcp_support', ':message') }}</span>
                </div>
     </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('tcp_autoscaling', trans("admin/siprouters.tcp_autoscaling"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::checkbox('tcp_autoscaling', "true", $router->tcp_autoscaling) !!}
                    <span class="help-block">{{ $errors->first('tcp_autoscaling', ':message') }}</span>
                </div>
     </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                    {!! Form::label('tcp_port', trans("admin/siprouters.tcp_port"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('tcp_port', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('tcp_port', ':message') }}</span>
                    </div>
        </div>

        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('tls_support', trans("admin/siprouters.tls_support"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::checkbox('tls_support', "true", $router->tls_support) !!}
                    <span class="help-block">{{ $errors->first('tls_support', ':message') }}</span>
                </div>
     </div>
        <div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                    {!! Form::label('tls_port', trans("admin/siprouters.tls_port"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('tls_port', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('tls_port', ':message') }}</span>
                    </div>
        </div>
        <div class="form-group  {{ $errors->has('default') ? 'has-error' : '' }}">
            {!! Form::label('default', trans("admin/siprouters.default"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('default', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('default', '1', @isset($router)? $router->default : 'false') !!}
                {!! Form::label('default', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('default', '0', @isset($router)? $router->default : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/siprouters.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($router)? $router->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($router)? $router->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($router))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
        @if (isset($router))
    <div class="tab-pane" id="tab-digitmapping">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <br/>
                    <a href="/admin/router/{{$router->id}}/add_digitmapping" class="btn btn-success">Add Mapping</a>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="token" value="{{csrf_token()}}"/>
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>ANI</th>
                        <th>DNIS</th>
                        <th>Route 1</th>
                        <th>Route 2</th>
                        <th>Route 3</th>
                        <th>Route 4</th>
                        <th>Route 5</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($digitMappings as $mapping)
                            <tr>
                                <td>{{$mapping->ani}}</td>
                                <td>{{$mapping->dnis}}</td>
                                <td>{{$mapping->route1_name}}</td>
                                <td>{{$mapping->route2_name}}</td>
                                <td>{{$mapping->route3_name}}</td>
                                <td>{{$mapping->route4_name}}</td>
                                <td>{{$mapping->route5_name}}</td>
                                <td>
                                    <a class="btn btn-info" href="/admin/router/{{$router->id}}/edit_digitmapping/{{$mapping->id}}">Edit</a>
                                    <button type="button" class="btn btn-danger del-digitmapping" data-id="{{$mapping->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif


        @if (isset($router))
    <div class="tab-pane" id="tab-servers">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <br/>
                    <a href="/admin/router/{{$router->id}}/add_server" class="btn btn-success">Add Host</a>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="token" value="{{csrf_token()}}"/>
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>Name</th>
                        <th>IP Address</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($servers as $server)
                            <tr>
                                <td>{{$server->name}}</td>
                                <td>{{$server->ip_address}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger del-server" data-id="{{$server->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif
    @if (isset($router))
    <div class="tab-pane" id="tab-rtpproxies">
        <div class="row">
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>Socket address</th>
                        <th>Set ID</th>
                        <th>Priority</th>
                    </thead>
                    <tbody>
                        @foreach ($rtpproxies as $proxy)
                            <tr>
                                <td>{{$proxy->rtpproxy_sock}}</td>
                                <td>{{$proxy->set_id}}</td>
                                <td>{{$proxy->priority}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif

    {!! Form::close() !!}
    @endsection @section('scripts')
        <script type="text/javascript">
            $(function () {
                @if (!empty($router))
                    var routerId = "{{$router->id}}";
                @else
                    var routerId = null;
                @endif

                function confirm_it() {
                    var sure = window.confirm("Are you sure?");
                    return sure;
                }
                $("#roles").select2()
                $(".del-server").each(function() {
                    $( this ).click(function() {
                        if (!confirm_it()) {
                            return;
                        }
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/router/" + routerId + "/del_server/" + id, params, function() {
                            alert("Server deleted..");
                            window.location.reload();
                        });
                    });
                });
                $(".del-digitmapping").each(function() {
                    $( this ).click(function() {
                        if (!confirm_it()) {
                            return;
                        }

                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/router/" + routerId + "/del_digitmapping/" + id, params, function() {
                            alert("Digit mapping deleted..");
                            window.location.reload();
                        });
                    });
                });
                $(".del-ip").each(function() {
                    $( this ).click(function() {
                        if (!confirm_it()) {
                            return;
                        }
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/router/" + routerId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
