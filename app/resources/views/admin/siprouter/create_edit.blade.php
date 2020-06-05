@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (!empty($servers))
     <li><a href="#tab-servers" data-toggle="tab"> {{
            trans("admin/modal.servers") }}</a></li>
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
<div class="form-group no-padding {{ $errors->has('private_ip_address') ? 'has-error' : '' }}">
                {!! Form::label('region', trans("admin/siprouters.region"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('region', $regions, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('region', ':message') }}</span>
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

    {!! Form::close() !!}
    @endsection @section('scripts')
        <script type="text/javascript">
            $(function () {
                @if (!empty($router))
                    var routerId = "{{$router->id}}";
                @else
                    var routerId = null;
                @endif
                $("#roles").select2()
                $(".del-server").each(function() {
                    $( this ).click(function() {
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
                $(".del-ip").each(function() {
                    $( this ).click(function() {
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
