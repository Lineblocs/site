@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($region))
{!! Form::model($region, array('url' => url('admin/region') . '/' . $region->id, 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/region'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/sipregions.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('code') ? 'has-error' : '' }}">
            {!! Form::label('code', trans("admin/sipregions.code"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('code', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/admin.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($region)? $region->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($region)? $region->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($region))
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
        @if (isset($region))
        var token = $("#_token").val();
        $(".del-region").each(function() {
            $( this ).click(function() {
                var confirm  = window.confirm("Are you sure ?");
                var regionId = $( this ).attr("data-id");
                if (confirm) {
                    $.post("/admin/region/{{$region->id}}/del_region/" + regionId, {"_token": token}, function() {
                        console.log("deleted..");
                        window.location.reload();
                    });
                }
            });
        });
         $(".del-ratecenter").each(function() {
            $( this ).click(function() {
                var confirm  = window.confirm("Are you sure ?");
                var centerId = $( this ).attr("data-id");
                var regionId = $( this ).attr("data-region-id");
                if (confirm) {
                    $.post("/admin/region/{{$region->id}}/region/" + regionId + "/del_ratecenter/" + centerId, {"_token": token}, function() {
                        console.log("deleted..");
                        window.location.reload();
                    });
                }
            });
        });
        @endif

    </script>
</div>
@endsection