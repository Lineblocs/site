@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
    <li><a href="#tab-prefixes" data-toggle="tab"> {{
            trans("admin/modal.rates") }}</a></li>
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
        <p style="white-space: break;"><strong>Note:</strong> you can add many prefixes as needed. Also, if you need match on a subscriber code you can add a hyphen next to the dial prefix followed by the subscriber code

        For example if you wanted to set a rate for the 955 subscriber code you would add the following:<br?
        Destination:<br/>
        907-955<br/>
        Rate:<br/>
        <your rate><br/><br/>

        If your trying to set one rate for all subscriber codes you can add it without any hyphens or subscriber codes.
        Destination:<br/>
        955<br/>
        Rate:<br/>
        <your rate>

        If multiple routes are matched during routing, the one with the most digits has the highest precedence.
    </p>
</div>
<div class="import-rate">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="row form-group">
                    <div class="col-md-12">
                        <h3>Import rates</h3>
                    </div>
                </div>
                <div class="row upload-part">
                    <div class="col-md-12">
                        <input type="hidden" name="upload_token" value="{!! csrf_token() !!}"/>
                        <input type="file" id="rateDeckFile" name="rate_deck_import" />
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <button type="button" id="importRatesBtn" class="btn btn-success btn-sm">Upload</button>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>

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
                $("#importRatesBtn").click(function(ev) {
                    console.log("submitted upload form");
                    ev.stopPropagation();
                    ev.preventDefault();
                    const formData = new FormData();
                    const fileSelector = document.querySelector("#rateDeckFile");
                    if (fileSelector.files.length === 0) {
                        alert("Please select a file.");
                        return;
                    }
                    const fileInput = fileSelector.files[0];
                    const token = $("input[name='upload_token']").val();
                    formData.append('rate_deck_import', fileInput);
                    formData.append('_token', token);
                    const postDataUrl = "./upload-rates";
                    $.ajax({
                        type: "POST",
                        url: postDataUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data, textStatus, jqXHR) {
                            //process data
                            if ( !data.success ) {
                                alert("Error occured: " + data.msg);
                                return;
                            }
                            console.log("processed upload successfully")
                            alert("Rates were uploaded successfully.");
                            document.location.reload();
                        },
                        error: function(data, textStatus, jqXHR) {
                            //process error msg
                            console.log("error uploading rate deck data ", arguments);
                        }
                    });
                });
            });
        </script>
</div>
@endsection
