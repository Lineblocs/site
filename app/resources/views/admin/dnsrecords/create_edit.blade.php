@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

</ul>
<!-- ./ tabs -->
@if (isset($dns))
{!! Form::model($dns, array('url' => url('admin/dns') . '/' . $dns->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/dns'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">

        <div class="form-group  {{ $errors->has('host') ? 'has-error' : '' }}">
            {!! Form::label('host', trans("admin/dnsrecords.host"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('host', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('host', ':message') }}</span>
            </div>
        </div>


        <div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
            {!! Form::label('type', trans("admin/dnsrecords.type"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('type', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('type', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('value') ? 'has-error' : '' }}">
            {!! Form::label('value', trans("admin/dnsrecords.value"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('value', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('value', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('ttl') ? 'has-error' : '' }}">
            {!! Form::label('ttl', trans("admin/dnsrecords.ttl"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('ttl', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('ttl', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($dns))
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
                @if (!empty($dns))
                    var dnsId = "{{$dns->id}}";
                @else
                    var dnsId = null;
                @endif
                $("#roles").select2()
                $(".del-server").each(function() {
                    $( this ).click(function() {
                        var id = $( this ).attr("data-id");
                        var params = {
                            "_token": $("#token").val()
                        };
                        $.post("/admin/dns/" + dnsId + "/del_server/" + id, params, function() {
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
                        $.post("/admin/dns/" + dnsId + "/del_ip/" + id, params, function() {
                            alert("IP deleted..");
                            window.location.reload();
                        });
                    });
                });
            });
        </script>
</div>
@endsection
