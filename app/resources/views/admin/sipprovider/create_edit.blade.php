@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (!empty($hosts))
     <li><a href="#tab-hosts" data-toggle="tab"> {{
            trans("admin/modal.hosts") }}</a></li>
            @endif
            @if (!empty($ips))
     <li><a href="#tab-ips" data-toggle="tab"> {{
            trans("admin/modal.ip_whitelist") }}</a></li>
            @endif
            @if (!empty($rates))
     <li><a href="#tab-rates" data-toggle="tab"> {{
            trans("admin/modal.rates") }}</a></li>
            @endif

</ul>
<!-- ./ tabs -->
@if (isset($provider))
{!! Form::model($provider, array('url' => url('admin/provider') . '/' . $provider->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/provider'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/sipproviders.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('api_name') ? 'has-error' : '' }}">
            {!! Form::label('api_name', trans("admin/sipproviders.api_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('tags') ? 'has-error' : '' }}">
            {!! Form::label('tags', trans("admin/sipproviders.tags"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('tags', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('tags', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('country') ? 'has-error' : '' }}">
            {!! Form::label('country', trans("admin/sipproviders.country"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('country', $countries, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('country', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('dial_prefix') ? 'has-error' : '' }}">
            {!! Form::label('dial_prefix', trans("admin/sipproviders.dial_prefix"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('dial_prefix', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('dial_prefix', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('priority') ? 'has-error' : '' }}">
            {!! Form::label('priority', trans("admin/sipproviders.priority"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('priority', null, array('class' => 'form-control', 'min' => '1', 'max' => '10')) !!}
                <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('host') ? 'has-error' : '' }}">
            {!! Form::label('host', trans("admin/sipproviders.host"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('host', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('host', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('carrier_key') ? 'has-error' : '' }}">
            {!! Form::label('carrier_key', trans("admin/sipproviders.carrier_key"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('carrier_key', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('carrier_key', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('type_of_provider') ? 'has-error' : '' }}">
            {!! Form::label('type_of_provider', trans("admin/sipproviders.type_of_provider"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('type_of_provider', $providerTypes, null, array('class' => 'form-control', 'id' => 'status')) !!}
                <span class="help-block">{{ $errors->first('type_of_provider', ':message') }}</span>
            </div>
        </div>





        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/sipproviders.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($provider)? $provider->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($provider)? $provider->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($provider))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
        @if (isset($provider))
    <div class="tab-pane" id="tab-hosts">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <br/>
                    <a href="/admin/provider/{{$provider->id}}/add_host" class="btn btn-success">Add Host</a>
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
                        <th>Priority</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($hosts as $host)
                            <tr>
                                <td>{{$host->name}}</td>
                                <td>{{$host->ip_address}}</td>
                                <td>{{$host->priority}}</td>
                                <td>
                                    <a href="/admin/provider/{{$provider->id}}/edit_host/{{$host->id}}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger del-host" data-id="{{$host->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @endif
        @if (isset($provider))
    <div class="tab-pane" id="tab-ips">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <br/>
                    <a href="/admin/provider/{{$provider->id}}/add_ip" class="btn btn-success">Add IP</a>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="token" value="{{csrf_token()}}"/>
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>IP Address</th>
                        <th>Range</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($ips as $ip)
                            <tr>
                                <td>{{$ip->ip_address}}</td>
                                <td>{{$ip->range}}</td>
                                <td>
                                    <a href="/admin/provider/{{$provider->id}}/edit_ip/{{$ip->id}}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger del-ip" data-id="{{$ip->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
            @endif
        @if (isset($provider))
    <div class="tab-pane" id="tab-rates">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <br/>
                    <a href="/admin/provider/{{$provider->id}}/add_rate" class="btn btn-success">Add Rate</a>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="token" value="{{csrf_token()}}"/>
            <div class="col-md-12">
                <table class="table stripped">
                    <thead>
                        <th>Rate Reference</th>
                        <th>Rate</th>
                        <th>Priority</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($rates as $rate)
                            <tr>
                                <td>{{$rate->name}}</td>
                                <td>{{$rate->rate}}</td>
                                <td>{{$rate->priority}}</td>
                                <td>
                                    <a href="/admin/provider/{{$provider->id}}/edit_rate/{{$rate->id}}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger del-rate" data-id="{{$rate->id}}">Delete</button>
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
                @if (!empty($provider))
                    var providerId = "{{$provider->id}}";
                @else
                    var providerId = null;
                @endif
                $("#roles").select2()
                $(".del-host").each(function() {
                    $( this ).click(function() {
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/provider/" + providerId + "/del_host/" + id, params, function() {
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
                        $.post("/admin/provider/" + providerId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
                $(".del-rate").each(function() {
                    $( this ).click(function() {
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/provider/" + providerId + "/del_rate/" + id, params, function() {
                            alert("Rate deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
