@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->        <div class="form-group  {{ $errors->has('api_number') ? 'has-error' : '' }}">
            {!! Form::label('api_number', trans("admin/api_numbers.api_number"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_number', ':message') }}</span>
            </div>
        </div>
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
