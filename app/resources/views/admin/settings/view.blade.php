@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/settings.api_credentials") !!} :: @parent
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
                <h1>AWS storage and TTS APIs</h1>
            </div>
            <hr/>

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
                <label for="aws_region">AWS region</label>
                <div class="controls">
                    <select class="form-control" name="aws_region" id="aws_region">
                        @foreach ( $aws_regions as $key => $region )
                            @if ($key==$selected_region)
                                <option value="{{$key}}" selected>{{$region}}</option>
                            @else
                                <option value="{{$key}}">{{$region}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="s3_bucket">S3 bucket</label>
                <div class="controls">
                    <input id="s3_bucket" type="text" class="form-control" name="s3_bucket" value="{{$creds->s3_bucket}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="google_service_account_json">Google service account JSON</label>
                <small>note: GCP is currently used for all text to speech processing.</small>
                <div class="controls">
                    <textarea id="google_service_account_json"  class="form-control" name="google_service_account_json">{{$creds->google_service_account_json}}</textarea>
                </div>
            </div>

            <div class="row form-group">
                <h1>Stripe credentials</h1>
            </div>
            <hr/>
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
                <h1>PayPal REST API credentials</h1>
            </div>
            <hr/>

            <div class="row form-group">
                <label for="paypal_test_client_id">Test client ID</label>
                <div class="controls">
                    <input id="paypal_test_client_id" type="text" class="form-control" name="paypal_test_client_id" value="{{$creds->paypal_test_client_id}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="paypal_test_client_secret">Test client secret</label>
                <div class="controls">
                    <input id="paypal_test_client_secret" type="text" class="form-control" name="paypal_test_client_secret" value="{{$creds->paypal_test_client_secret}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="paypal_live_client_id">Live client ID</label>
                <div class="controls">
                    <input id="paypal_live_client_id" type="text" class="form-control" name="paypal_live_client_id" value="{{$creds->paypal_live_client_id}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="paypal_live_client_secret">Live client secret</label>
                <div class="controls">
                    <input id="paypal_live_client_secret" type="text" class="form-control" name="paypal_live_client_secret" value="{{$creds->paypal_live_client_secret}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="paypal_mode">API mode</label>
                <div class="controls">
                    <select class="form-control" name="paypal_api_mode" id="paypal_mode">
                        @if ( $creds->paypal_api_mode == 'live')
                            <option value="live" selected>Live</option>
                        @else
                            <option value="live">Live</option>
                        @endif
                        @if ( $creds->paypal_api_mode == 'sandbox')
                            <option value="sandbox" selected>Sandbox</option>
                        @else
                            <option value="sandbox">Sandbox</option>
                        @endif
                    </select>
                </div>
            </div>


            <div class="row form-group">
                <h1>SMS & messaging APIs</h1>
            </div>
            <hr/>
           <div class="row form-group">
                <label for="telerivet_api_key">Telerivet API key</label>
                <div class="controls">
                    <input id="telerivet_api_key" type="text" class="form-control" name="telerivet_api_key" value="{{$creds->telerivet_api_key}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="telerivet_project_id">Telerivet Project ID</label>
                <div class="controls">
                    <input id="telerivet_project_id" type="text" class="form-control" name="telerivet_project_id" value="{{$creds->telerivet_project_id}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="whatsapp_phone_number_id">WhatsApp Phone Number ID</label>
                <div class="controls">
                    <input id="whatsapp_phone_number_id" type="text" class="form-control" name="whatsapp_phone_number_id" value="{{$creds->whatsapp_phone_number_id}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="whatsapp_access_token">WhatsApp Access Token</label>
                <div class="controls">
                    <input id="whatsapp_access_token" type="text" class="form-control" name="whatsapp_access_token" value="{{$creds->whatsapp_access_token}}"/>
                </div>
            </div>

            <div class="row form-group">
                <h1>Security & DDoS</h1>
            </div>
            <hr/>
           <div class="row form-group">
                <label for="recaptcha_sitekey">ReCaptcha site key</label>
                <div class="controls">
                    <input id="recaptcha_sitekey" type="text" class="form-control" name="recaptcha_sitekey" value="{{$creds->recaptcha_sitekey}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="recaptcha_privatekey">ReCaptcha Private key</label>
                <div class="controls">
                    <input id="recaptcha_privatekey" type="text" class="form-control" name="recaptcha_privatekey" value="{{$creds->recaptcha_privatekey}}"/>
                </div>
            </div>

            <div class="row form-group">
                <h1>Support ticket module APIs</h1>
            </div>
            <hr/>

           <div class="row form-group">
                <label for="zendesk_subdomain">Zendesk subdomain</label>
                <div class="controls">
                    <input id="zendesk_subdomain" type="text" class="form-control" name="zendesk_subdomain" value="{{$creds->zendesk_subdomain}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="zendesk_username">Zendesk Username</label>
                <div class="controls">
                    <input id="zendesk_username" type="text" class="form-control" name="zendesk_username" value="{{$creds->zendesk_username}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="zendesk_token">Zendesk Token</label>
                <div class="controls">
                    <input id="zendesk_token" type="text" class="form-control" name="zendesk_token" value="{{$creds->zendesk_token}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="intercom_workspace_id">Intercom workspace ID</label>
                <div class="controls">
                    <input id="intercom_workspace_id" type="text" class="form-control" name="intercom_workspace_id" value="{{$creds->intercom_workspace_id}}"/>
                </div>
            </div>



            <div class="row form-group">
                <label for="disqus_site">Disqus site</label>
                <div class="controls">
                    <input id="disqus_site" type="text" class="form-control" name="disqus_site" value="{{$creds->disqus_site}}"/>
                </div>
            </div>


            <div class="row form-group">
                <h1>SMTP & mailing</h1>
            </div>
            <hr/>
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
                <h1>SSO credentials</h1>
            </div>
            <hr/>

            <div class="row form-group">
            <h3>Google details</h3>
</div>
            <div class="row form-group">
                <label for="google_signin_developer_key">Developer key</label>
                <div class="controls">
                    <input id="google_signin_developer_key" class="form-control" name="google_signin_developer_key" value="{{$creds->google_signin_developer_key}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="google_signin_app_id">App ID</label>
                <div class="controls">
                    <input id="google_signin_app_id" class="form-control" name="google_signin_app_id" value="{{$creds->google_signin_app_id}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="google_signin_client_id">Client ID</label>
                <div class="controls">
                    <input id="google_signin_client_id" class="form-control" name="google_signin_client_id" value="{{$creds->google_signin_client_id}}" />
                </div>
            </div>

            <div class="row form-group">
            <h3>Microsoft details</h3>
</div>
            <div class="row form-group">
                <label for="msft_signin_client_id">Client ID</label>
                <div class="controls">
                    <input id="msft_signin_client_id" class="form-control" name="msft_signin_client_id" value="{{$creds->msft_signin_client_id}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="msft_signin_client_secret">Client secret</label>
                <div class="controls">
                    <input id="msft_signin_client_secret" class="form-control" name="msft_signin_client_secret" value="{{$creds->msft_signin_client_secret}}" />
                </div>
            </div>

            <div class="row form-group">
            <h3>Apple details</h3>
</div>
            <div class="row form-group">
                <label for="apple_signin_client_id">Client ID</label>
                <div class="controls">
                    <input id="apple_signin_client_id" class="form-control" name="apple_signin_client_id" value="{{$creds->apple_signin_client_id}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="apple_signin_client_secret">Client secret</label>
                <div class="controls">
                    <input id="apple_signin_client_secret" class="form-control" name="apple_signin_client_secret" value="{{$creds->apple_signin_client_secret}}" />
                </div>
            </div>


            <div class="row form-group">
                <h3>DNS provider API keys</h3>
            </div>

            <div class="row form-group">
                <label for="namecheap_api_key">Namecheap API key</label>
                <div class="controls">
                    <input id="namecheap_api_key" class="form-control" name="namecheap_api_key" value="{{$creds->namecheap_api_key}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="namecheap_api_user">Namecheap API user</label>
                <div class="controls">
                    <input id="namecheap_api_user" class="form-control" name="namecheap_api_user" value="{{$creds->namecheap_api_user}}" />
                </div>
            </div>

            <div class="row form-group">
            <h3>Microsoft details</h3>
</div>
            <div class="row form-group">
                <label for="msft_signin_client_id">Client ID</label>
                <div class="controls">
                    <input id="msft_signin_client_id" class="form-control" name="msft_signin_client_id" value="{{$creds->msft_signin_client_id}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="msft_signin_client_secret">Client secret</label>
                <div class="controls">
                    <input id="msft_signin_client_secret" class="form-control" name="msft_signin_client_secret" value="{{$creds->msft_signin_client_secret}}" />
                </div>
            </div>

            <div class="row form-group">
            <h3>Apple details</h3>
</div>
            <div class="row form-group">
                <label for="apple_signin_client_id">Client ID</label>
                <div class="controls">
                    <input id="apple_signin_client_id" class="form-control" name="apple_signin_client_id" value="{{$creds->apple_signin_client_id}}" />
                </div>
            </div>
            <div class="row form-group">
                <label for="apple_signin_client_secret">Client secret</label>
                <div class="controls">
                    <input id="apple_signin_client_secret" class="form-control" name="apple_signin_client_secret" value="{{$creds->apple_signin_client_secret}}" />
                </div>
            </div>


            <div class="row form-group">
            <h1>Analytics keys</h1>
</div>
            <hr/>

            <div class="row form-group">
            <h3>Google script tag</h3>
            </div>
            <div class="row form-group">
                <label for="google_analytics_script_tag">Google analytics tag</label>
                <div class="controls">
                    <textarea class="form-control" name="google_analytics_script_tag">{{$creds->google_analytics_script_tag}}</textarea>
                </div>
            </div>
            <div class="row form-group">
            <h3>Matomo tag</h3>
            </div>
            <div class="row form-group">
                <label for="matomo_analytics_tag">Matomo analytics tag</label>
                <div class="controls">
                    <textarea class="form-control" name="matomo_script_tag">{{$creds->matomo_script_tag}}</textarea>
                </div>
            </div>

            <div class="row form-group">
            <h3>Logging and stacktrace tools</h3>
</div>
            <div class="row form-group">
                <label for="sentry_dsn">Sentry DSN</label>
                <div class="controls">
                    <input class="form-control" name="sentry_dsn" value="{{$creds->sentry_dsn}}"/>
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
