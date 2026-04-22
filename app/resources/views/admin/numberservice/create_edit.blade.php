@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($numberservice))
{!! Form::model($numberservice, array('url' => url('admin/numberservice') . '/' . $numberservice->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/numberservice'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <h2>Provider details</h2>
        <hr/>
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/numberservices.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('key_name') ? 'has-error' : '' }}">
            {!! Form::label('key_name', trans("admin/numberservices.key_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('key_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('key_name', ':message') }}</span>
            </div>
        </div>

        <h2>API settings</h2>
        <hr/>
        <div class="form-group  {{ $errors->has('api_key') ? 'has-error' : '' }}">
            {!! Form::label('api_key', trans("admin/numberservices.api_key"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_key', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_key', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('api_secret') ? 'has-error' : '' }}">
            {!! Form::label('api_secret', trans("admin/numberservices.api_secret"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('api_secret', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('api_secret', ':message') }}</span>
            </div>
        </div>


        <h2>Config</h2>
        <hr/>
        <div id="configContainer">
            <ul id="config">
            </ul>
            <button class="btn btn-info" type="button" id="addConfigBtn">Add Parameter</button>
        </div>
        
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($numberservice))
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
            var currentConfig = null;
            @if (!empty($config))
                var currentConfig = {!! json_encode($config) !!};
            @endif

            var configList  = $("#config");

            function createKey(name, num) {
                var key = "config_params[" + name + "][" + num + "]";
                return key;
            }

            function createField(name, num, placeholder, value) {
                var key = createKey( name, num );
                var input = $("<input class='form-control'/>");
                input.attr('name', key);
                input.attr('placeholder', placeholder);
                input.attr('value', value);
                return input;
            }
            function addConfigItem(currentValues) {
                var num = $("ul#config li").length;
                var param = createField('param', num, 'Param', currentValues['param']);
                var value = createField('value', num, 'Value', currentValues['value']);
                var item = $("<li></li>");
                param.appendTo( item );
                value.appendTo( item );

                var remove = $("<button class='btn btn-danger btn-sm remove'>X</button>");
                remove.click( function() {
                    item.remove();
                });
                remove.appendTo( item );

                if (currentValues['id']) {
                    var id = $('<input type="hidden"/>');
                    var key = createKey( 'id', num );
                    id.attr('name', key);
                    id.attr('value', currentValues['id']);
                    id.appendTo( item );
                }

                item.appendTo( configList );
            }
            $("#addConfigBtn").click(function() {
                var initialValues = {
                    param: '',
                    value: ''
                };
                addConfigItem(initialValues);
            });

            if (currentConfig) {
                currentConfig.forEach((item) => {
                    addConfigItem( item );
                });
            }
        </script>
</div>
@endsection
