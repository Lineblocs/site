@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
    <li><a href="#tab-prefixes" data-toggle="tab"> {{
            trans("admin/modal.prefixes") }}</a></li>
</ul>
<!-- ./ tabs -->
@if (isset($rate))
{!! Form::model($rate, array('url' => url('admin/rate') . '/' . $rate->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/rate'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/callrates.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('call_rate') ? 'has-error' : '' }}">
            {!! Form::label('call_rate', trans("admin/callrates.default_call_rate"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('call_rate', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('call_rate', ':message') }}</span>
            </div>
        </div>
            <div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
            {!! Form::label('type', trans("admin/callrates.type"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('type', array('outbound' => 'Outbound', 'inbound' => 'Inbound'), null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('type', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('inbound') ? 'has-error' : '' }}">
            {!! Form::label('inbound', trans("admin/callrates.inbound"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('inbound', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('inbound', ':message') }}</span>
            </div>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($rate))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
    <!-- Rate deck definitions tab -->
    <div class="tab-pane" id="tab-prefixes">
        <br/>
    <div class="alert alert-warning" role="alert">
        <p style="white-space: break;"><strong>Note:</strong> you can add many prefixes as needed. Also, you may input a range of prefixes by separating the range with a hyphen.<br/><br/>

        For example if you wanted to set one rate for any destinations matching 907 to 955 you would use the following:<br/>
        Destination:<br/>
        907-955<br/>
        Rate:<br/>
        <your rate><br/><br/>

        If your trying to set a rate for only one destination you can refer to this example:
        Destination:<br/>
        955<br/>
        Rate:<br/>
        <your rate>
</div>
    </p>
        <table class="table stripped larger-hdgs">
            <thead>
                <th>Destination</th>
                <th>Prefix</th>
                <th>Rate/minute</th>
                <th>&nbsp;</th>
            </thead>
            <tbody id="prefixes">
            </table>
        </table>
        <button class="btn btn-success" type="button" id="addPrefixBtn">Add Prefix</button>
    </div>

    {!! Form::close() !!}
    @endsection @section('scripts')

        <script type="text/javascript">
        @if (isset($prefixes))
            var prefixes = {!! json_encode($prefixes) !!};
        @else
            var prefixes = [];
            @endif

            function createField(name, prefix) {
                var container =$("#prefixes");
                var length = container.find("tr").length;
                var td = $("<td></td>");
                var key = "prefixes[" + length + "][" + name + "]";
                var input = $("<input class='form-control'/>");
                if ( prefix ) {
                    input.val( prefix[name] );
                }

                input.attr("name", key);
                input.appendTo(td);
                return td;
            }
            function addPrefix(prefix) {
                var container =$("#prefixes");
                var length = container.find("tr").length;
                var tr = $("<tr></tr>");
                createField("destination", prefix).appendTo( tr );
                createField("dial_prefix", prefix).appendTo( tr );
                createField("rate", prefix).appendTo( tr );


                var td = $("<td></td>");
                var key = "prefixes[" + length + "][id]";
                var input = $("<input class='id' type='hidden'/>");
                if ( prefix ) {
                    input.val( prefix.id );
                }
                input.appendTo(td);


                td.appendTo(tr);
                var td = $("<td></td>");
                var remove = $("<button class='btn btn-danger'>X</button>");
                remove.click(function() {
                    tr.remove();
                });
                remove.appendTo(td);
                td.appendTo(tr);
                tr.appendTo(container);
                return tr;
            }
            $(function () {
                prefixes.forEach(function(prefix) {
                    var tr = addPrefix(prefix);
                });
                $("#addPrefixBtn").click(function() {
                    addPrefix();
                });
            });
        </script>
</div>
@endsection
