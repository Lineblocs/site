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
        <div class="form-group  {{ $errors->has('rtpproxy_sock') ? 'has-error' : '' }}">
            {!! Form::label('rtpproxy_sock', trans("admin/mediaservers.rtpproxy_sock"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('rtpproxy_sock', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('rtpproxy_sock', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  no-padding {{ $errors->has('set_id') ? 'has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::label('set_id', trans("admin/mediaservers.set_id"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('set_id', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('set_id', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('priority', trans("admin/mediaservers.priority"), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('priority', $ranges, null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('priority', ':message') }}</span>
                </div>
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
