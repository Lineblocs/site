@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/callrates.call_rates") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/settings.settings") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="">
            <div class="row form-group">
                <label for="aws_access_key_id">AWS access key</label>
                <div class="controls">
                    <input id="aws_access_key_id" type="text" class="form-control" name="aws_access_key_id" value="{{$creds->aws_access_key_id}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="aws_access_key_id">AWS secret access key</label>
                <div class="controls">
                    <input id="aws_secret_access_key" type="text" class="form-control" name="aws_secret_access_key" value="{{$creds->aws_secret_access_key}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="google_service_account_json">Google service account JSON</label>
                <div class="controls">
                    <textarea id="google_service_account_json"  class="form-control" name="google_service_account_json">{{$creds->google_service_account_json}}</textarea>
                </div>
            </div>

            <div class="row form-group">
                <label for="aws_region">AWS region</label>
                <div class="controls">
                    <select class="form-control" name="aws_region" id="aws_region">
                        @foreach ( $aws_regions as $key => $region )
                            @if ($region==$selected_region)
                                <option value="{{$key}}" selected>{{$region}}</option>
                            @else
                                <option value="{{$key}}">{{$region}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="stripe_private_key">Stripe Private Key</label>
                <div class="controls">
                    <input id="stripe_private_key" type="text" class="form-control" name="stripe_private_key" value="{{$creds->stripe_private_key}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="stripe_pub_key">Stripe Publishable Key</label>
                <div class="controls">
                    <input id="stripe_pub_key" type="text" class="form-control" name="stripe_pub_key" value="{{$creds->stripe_pub_key}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="stripe_test_private_key">Stripe Test Private Key</label>
                <div class="controls">
                    <input id="stripe_test_private_key" type="text" class="form-control" name="stripe_test_private_key" value="{{$creds->stripe_test_private_key}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="stripe_test_pub_key">Stripe Test Publishable Key</label>
                <div class="controls">
                    <input id="stripe_test_pub_key" type="text" class="form-control" name="stripe_test_pub_key" value="{{$creds->stripe_test_pub_key}}"/>
                </div>
            </div>



            <div class="row form-group">
                <label for="stripe_mode">Stripe mode</label>
                <div class="controls">
                    <select class="form-control" name="stripe_mode" id="stripe_mode">
                        @if ( $creds->stripe_mode == 'live')
                            <option value="live" selected>Live</option>
                        @else
                            <option value="live">Live</option>
                        @endif
                        @if ( $creds->stripe_mode == 'test')
                            <option value="test" selected>Test</option>
                        @else
                            <option value="test">Test</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="smtp_host">SMTP host</label>
                <div class="controls">
                    <input id="smtp_host" type="text" class="form-control" name="smtp_host" value="{{$creds->smtp_host}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="smtp_port">SMTP port</label>
                <div class="controls">
                    <input id="smtp_port" type="text" class="form-control" name="smtp_port" value="{{$creds->smtp_port}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="smtp_user">SMTP user</label>
                <div class="controls">
                    <input id="smtp_user" type="text" class="form-control" name="smtp_user" value="{{$creds->smtp_user}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="smtp_password">SMTP password</label>
                <div class="controls">
                    <input id="smtp_password" type="text" class="form-control" name="smtp_password" value="{{$creds->smtp_password}}"/>
                </div>
            </div>


            <div class="row form-group">
                <label for="smtp_tls">SMTP TLS</label>
                <div class="controls">
                    <select class="form-control" name="smtp_tls" id="smtp_tls">
                        @if ( $creds->smtp_tls )
                            <option value="1" selected>On</option>
                            <option value="0">Off</option>
                        @else
                            <option value="1">On</option>
                            <option value="0" selected>Off</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
