@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>
            @if (!empty($orig_settings))
     <li><a href="#tab-origination" data-toggle="tab"> {{
            trans("admin/modal.origination") }}</a></li>
            @endif
            @if (!empty($term_settings))
     <li><a href="#tab-termination" data-toggle="tab"> {{
            trans("admin/modal.termination") }}</a></li>
            @endif

</ul>
<!-- ./ tabs -->
@if (isset($trunk))
{!! Form::model($trunk, array('url' => url('admin/trunk') . '/' . $trunk->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => url('admin/trunk'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/siptrunks.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
     </div>

    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('workspace_id') ? 'has-error' : '' }}">
            {!! Form::label('workspace_id', trans("admin/siptrunks.workspace_id"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('workspace_id', $workspaces, @isset($trunk)? $trunk->workspace_id : NULL, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('workspace_id', ':message') }}</span>
            </div>
     </div>
     </div>


        <div class="form-group  {{ $errors->has('record') ? 'has-error' : '' }}">
            {!! Form::label('record', trans("admin/siptrunks.record"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('record', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('record', '1', @isset($trunk)? $trunk->record : 'false') !!}
                {!! Form::label('record', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('record', '0', @isset($trunk)? $trunk->record : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('active') ? 'has-error' : '' }}">
            {!! Form::label('active', trans("admin/siptrunks.active"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('active', trans("admin/admin.yes"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '1', @isset($trunk)? $trunk->active : 'false') !!}
                {!! Form::label('active', trans("admin/admin.no"), array('class' => 'control-label')) !!}
                {!! Form::radio('active', '0', @isset($trunk)? $trunk->active : 'true') !!}
                <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">
            <span class="glyphicon glyphicon-ok-circle"></span>
            @if	(isset($trunk))
                {{ trans("admin/modal.edit") }}
            @else
                {{trans("admin/modal.create") }}
            @endif
        </button>
        </div>
    </div>
        @if (isset($trunk))
    <div class="tab-pane" id="tab-origination">
        <div class="row">
            <div class="col-md-3">Recovery SIP URI</div>
            <div class="col-md-9">
                <input class="form-control" name="orig_settings[recovery_sip_uri]" value="{{$orig_settings->recovery_sip_uri}}" placeholder="e.g: sip:example.org:5060"></input>
     </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul id="endpoints">
                </ul>
     </div>
            <div class="col-md-12">
                <button type="button" id="addEndpoint" class="btn btn-success">Add endpoint</button>
     </div>
        </div>
     </div>
            @endif
        @if (isset($trunk))
    <div class="tab-pane" id="tab-termination">
        <div class="row">
            <div class="col-md-3">SIP URI</div>
            <div class="col-md-9">
                <input class="form-control" name="term_settings[sip_addr]" value="{{$term_settings->sip_addr}}" placeholder="e.g: sip:example.org:5060"></input>
     </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul id="acls">
                </ul>
     </div>
            <div class="col-md-12">
                <button type="button" id="addACL" class="btn btn-success">Add ACL</button>
     </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <ul id="credentials">
            </ul>
     </div>
            <div class="col-md-12">
            <button type="button" id="addCredential" class="btn btn-success">Add credential</button>
     </div>
        </div>

     @endif

    {!! Form::close() !!}
    @endsection @section('scripts')
        <script type="text/javascript">
            function make_key( resource, key, count ) {
                return resource + "[" + key + "]" + "[" + count + "]";
            }
            function add_endpoint(data) {
                var list = $("#endpoints");
                var item = $("<li></li>");
                var count = list.find("li").length;
                var uri = $("<input type='text' class='form-control'/>")
                uri.attr('name', make_key( "orig_endpoints", "sip_uri", count ));
                uri.attr('placeholder', 'e.g: sip:example.org:5060');
                if ( data ) {
                    uri.val( data.sip_uri );
                    var id = $("<input type='hidden'/>");
                    id.attr('name', make_key( "orig_endpoints", "id", count ));
                    id.val( data.id );
                }
                uri.appendTo( item );
                item.appendTo( list );
            }
            function add_acl(data) {
                var list = $("#acls");
                var item = $("<li></li>");
                var count = list.find("li").length;
                var identifier= $("<input type='text' class='form-control'/>")
                identifier.attr('name', make_key( "term_acls", "identifier", count ));
                var cidr_addr= $("<input type='text' class='form-control'/>")
                cidr_addr.attr('name', make_key( "term_acls", "cidr_addr", count ));
                identifier.attr('placeholder', 'e.g: main');
                cidr_addr.attr('placeholder', 'e.g: 0.0.0.0/0');
                if ( data ) {
                    identifier.val( data.identifier );
                    cidr_addr.val( data.cidr_addr );
                    var id = $("<input type='hidden'/>");
                    id.attr('name', make_key( "term_acls", "id", count ));
                    id.val( data.id );
                }
                identifier.appendTo( item );
                cidr_addr.appendTo( item );
                item.appendTo( list );

            }
            function add_cred(data) {
                var list = $("#credentials");
                var item = $("<li></li>");
                var count = list.find("li").length;
                var username= $("<input type='text' class='form-control'/>")
                username.attr('name', make_key( "term_acls", "identifier", count ));
                username.attr('name', make_key( "term_creds", "username", count ));
                var password= $("<input type='text' class='form-control'/>")
                password.attr('name', make_key( "term_creds", "password", count ));
                username.attr('placeholder', 'e.g: John');
                password.attr('placeholder', 'your password');
                if ( data ) {
                    username.val( data.username );
                    password.val( data.password );
                    var id = $("<input type='hidden'/>");
                    id.attr('name', make_key( "term_creds", "id", count ));
                    id.val( data.id );
                }
                username.appendTo( item );

                password.appendTo( item );
                item.appendTo( list );
            }
            $(function () {
                var endpoints = [];
                @if (!empty( $orig_endpoints ))
                    var endpoints = {!! json_encode($orig_endpoints) !!};
                @endif
                var acls = [];
                @if (!empty( $term_acls ))
                    var acls = {!! json_encode($term_acls) !!};
                @endif
                var creds = [];
                @if (!empty( $term_creds ))
                    var creds = {!! json_encode($term_creds) !!};
                @endif
                $("#addEndpoint").click(function() {
                    add_endpoint();

                })
                $("#addACL").click(function() {
                    add_acl();
                })
                $("#addCredential").click(function() {
                    add_cred();
                })
                endpoints.forEach((item) => {
                    add_endpoint( item );
                });
                acls.forEach((acl) => {
                    add_acl( acl );
                });
                creds.forEach((cred) => {
                    add_cred( cred );
                });
            })();
        </script>
</div>
@endsection
