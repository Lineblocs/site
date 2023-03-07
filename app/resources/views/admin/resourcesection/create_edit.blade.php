@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"> {{
            trans("admin/modal.general") }}</a></li>

        </ul>
        <!-- ./ tabs -->
        @if (isset($resourcesection))
        {!! Form::model($resourcesection, array('url' => url('admin/resourcesection') . '/' . $resourcesection->id, 'method' => 'put', 'id' => 'fupload', 'class' => 'bf', 'files'=> true)) !!}
        @else
        {!! Form::open(array('url' => url('admin/resourcesection'), 'method' => 'post', 'class' => 'bf', 'files'=> true, 'id' => 'fupload')) !!}
        @endif
        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- General tab -->
            <div class="tab-pane active" id="tab-general">
                <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('key_name', trans("admin/resourcesections.key_name"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('key_name', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('key_name', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', trans("admin/resourcesections.name"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! Form::label('description', trans("admin/resourcesections.description"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::text('description', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('image') ? 'has-error' : '' }}">
                    {!! Form::label('image', trans("admin/resourcesections.image"), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::file('image', null, array('class' => 'form-control')) !!}
                        <span class="help-block">{{ $errors->first('image', ':message') }}</span>
                    </div>
                </div>

            </div>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if (isset($resourcesection))
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
            function make_key( resource, key, count ) {
                return resource + "[" + key + "]" + "[" + count + "]";
            }
            function add_endpoint(data) {
                var list = $("#endpoints");
                var item = $("<li class='add-btm-margin'></li>");
                var count = list.find("li").length;
                var uri = $("<input type='text' class='form-control trunk-list-input'/>")
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
                var item = $("<li class='mb-2 add-btm-margin'></li>");
                var count = list.find("li").length;
                var identifier= $("<input type='text' class='form-control trunk-list-input'/>")
                identifier.attr('name', make_key( "term_acls", "identifier", count ));
                var cidr_addr= $("<input type='text' class='form-control trunk-list-input'/>")
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
                var item = $("<li class='add-btm-margin'></li>");
                var count = list.find("li").length;
                var username= $("<input type='text' class='form-control trunk-list-input'/>")

                username.attr('name', make_key( "term_acls", "identifier", count ));
                username.attr('name', make_key( "term_creds", "username", count ));
                var password= $("<input type='text' class='form-control trunk-list-input'/>")
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
