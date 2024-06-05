@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
    <li class=""><a href="#tab-regions" data-toggle="tab"> {{
            trans("admin/modal.regions") }}</a></li>
    <li class=""><a href="#tab-ratecenters" data-toggle="tab"> {{
            trans("admin/modal.ratecenters") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($country))
{!! Form::model($country, array('url' => url('admin/country') . '/' . $country->id, 'method' => 'put', 'class' => 'bf',
'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/country'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('iso', trans("admin/sipcountrys.iso"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('iso', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('iso', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/sipcountrys.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('country_code') ? 'has-error' : '' }}">
            {!! Form::label('country_code', trans("admin/sipcountrys.country_code"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('country_code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('country_code', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/admin.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($country)? $country->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($country)? $country->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($country))
                {{ trans("admin/modal.edit") }}
                @else
                {{trans("admin/modal.create") }}
                @endif
            </button>
        </div>
    </div>
    <!-- regions tab -->
    <div class="tab-pane" id="tab-regions">
        @if (isset($country))
            <div class="row">
                <div class="col-md-3">
                    <h2>Regions</h2>
                </div>
                <div class="col-md-9">
                    <a class="btn btn-info pull-right" href="/admin/country/{{$country->id}}/add_region">Add Region</a>
                </div>
            </div>
            <table class="table stripped">
                <thead>
                    <th>Code</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($regions as $item)
                    <tr>
                        <td>{{$item['code']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>
                            <a class="btn btn-info" href="/admin/country/{{$country->id}}/add_region/{{$item->id}}">Edit</a>
                            <a data-id="{{$item->id}}" class="btn btn-info del-region" href="#">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <center><h2>Save Country to see</h1></center>
            @endif
    </div>
    <!-- rate centers tab -->
    <div class="tab-pane" id="tab-ratecenters">
        @if (isset($country))
        <h2>Rate Centers</h2>
        <small>grouped by regions</small>
        @foreach ($regions as $region)
            <div class="row">
                <div class="col-md-3">
                    <h4>{{$region->name}}</h4>
                </div>
                <div class="col-md-9">
                    <a class="btn btn-info pull-right" href="/admin/country/{{$country->id}}/region/{{$region->id}}/add_ratecenter">Add Rate Center</a>
                </div>
            </div>
            <table class="table stripped">
                <thead>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($region->getRateCenters() as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>
                            <a class="btn btn-info" href="/admin/country/{{$country->id}}/region/{{$region->id}}/add_ratecenter/{{$item->id}}">Edit</a>
                            <a data-id="{{$item->id}}" data-region-id="{{$region->id}}" class="btn btn-info del-ratecenter" href="#">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
            @else
            <center><h2>Save Country to see</h1></center>
            @endif

            <input type="hidden" id="_token" value="{{csrf_token()}}"/>
    </div>
    {!! Form::close() !!}
    @endsection @section('scripts')
    <script type="text/javascript">
        $(function () {
            $("#roles").select2()
        });
        @if (isset($country))
        var token = $("#_token").val();
        $(".del-region").each(function() {
            $( this ).click(function() {
                var confirm  = window.confirm("Are you sure ?");
                var regionId = $( this ).attr("data-id");
                if (confirm) {
                    $.post("/admin/country/{{$country->id}}/del_region/" + regionId, {"_token": token}, function() {
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
                    $.post("/admin/country/{{$country->id}}/region/" + regionId + "/del_ratecenter/" + centerId, {"_token": token}, function() {
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