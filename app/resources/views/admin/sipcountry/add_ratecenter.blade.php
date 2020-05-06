@extends('admin.layouts.modal', ['backLocation' => url('admin/country/' . $country->id . '/edit')])
{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($center))
{!! Form::model($center, array('url' => url('admin/country/' . $country->id . '/region/' . $region->id . '/add_ratecenter/'. $center->id), 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/country/' . $country->id . '/region/' . $region->id . '/add_ratecenter'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/sipratecenters.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
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
        <h5>SIP Providers</h5>
        <ul id="providers">
            @if (isset($center))
                @foreach ($providers as $cnt => $provider)
                    @if ($center->hasProvider($centerProviders, $provider))
                        <input type="checkbox" name="providers[{{$provider->id}}]" checked="checked"/>
                    @else
                        <input type="checkbox" name="providers[{{$provider->id}}]"/>
                    @endif
                    <label>{{$provider->name}}</label>
                @endforeach
            @else
                @foreach ($providers as $cnt => $provider)
                    <input type="checkbox" name="providers[{{$provider->id}}]"/>
                    <label>{{$provider->name}}</label>
                @endforeach
            @endif
        </ul>

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
    </script>
</div>
@endsection