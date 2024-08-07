@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/customizations.customizations") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            {!! trans("admin/settings.settings") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <h3>Logos</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="app_logo">App logo</label>
                <div class="controls">
                    <input id="app_logo" type="file" class="form-control" name="app_logo" value=""/>
                    @if (!empty( $record->app_logo))
                        <a target="_blank" href="/assets/img/{{$record->app_logo}}">View current</a>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="app_icon">Icon</label>
                <div class="controls">
                    <input id="app_icon" type="file" class="form-control" name="app_icon" value=""/>
                    @if (!empty( $record->app_icon))
                        <a target="_blank" href="/assets/img/{{$record->app_icon}}">View current</a>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="alt_app_logo">Alt App logo (for login and user facing pages)</label>
                <div class="controls">
                    <input id="alt_app_logo" type="file" class="form-control" name="alt_app_logo" value=""/>
                    @if (!empty( $record->alt_app_logo))
                        <a target="_blank" href="/assets/img/{{$record->alt_app_logo}}">View current</a>
                    @endif
                </div>
            </div>

            <div class="row form-group">
                <label for="admin_portal_logo">Admin portal logo</label>
                <div class="controls">
                    <input id="admin_portal_logo" type="file" class="form-control" name="admin_portal_logo" value=""/>
                    @if (!empty( $record->admin_portal_logo))
                        <a target="_blank" href="/assets/img/{{$record->admin_portal_logo}}">View current</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <h3>Theme settings</h3>
                <hr/>
            </div>

            <div class="row form-group">
                <label for="color_scheme">Color scheme</label>
                <div class="controls">
                    <select name="color_scheme" class="form-control" id="color_scheme">
                        @if ( $record->color_scheme == 'standard')
                            <option value="standard" selected>Standard blue</option>
                        @else
                            <option value="standard">Standard blue</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="layout_type">Layout type</label>
                <div class="controls">
                    <select name="layout_type" class="form-control" id="layout_type">
                        @if ( $record->color_scheme == 'normal')
                            <option value="normal" selected>Normal</option>
                        @else
                            <option value="normal">Normal</option>
                        @endif

                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->

                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="primary_font">Primary font</label>
                <div class="controls">
                    <select name="primary_font" class="form-control" id="primary_font">
                        @if ( $record->primary_font == 'arial')
                            <option value="arial" selected>Arial</option>
                        @else
                            <option value="arial">Arial</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>


            <div class="row form-group">
                <label for="secondary_font">Secondary font</label>
                <div class="controls">
                    <select name="secondary_font" class="form-control" id="secondary_font">
                        @if ( $record->secondary_font == 'arial')
                            <option value="arial" selected>Arial</option>
                        @else
                            <option value="arial">Arial</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

           <div class="row">
                <h3>Global contact details</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="contact_address">Address</label>
                <div class="controls">
                    <textarea name="contact_address" id="contact_address" class="form-control" value="{{$record->contact_address}}">{{$record->contact_address}}</textarea>
                </div>
            </div>
            <div class="row form-group">
                <label for="contact_phone_number">Phone Number</label>
                <div class="controls">
                    <input name="contact_phone_number" id="contact_phone_number" class="form-control" value="{{$record->contact_phone_number}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="contact_email">Email</label>
                <div class="controls">
                    <input name="contact_email" id="contact_email" class="form-control" value="{{$record->contact_email}}"/>
                </div>
            </div>


            <div class="row">
                <h3>Social media links</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="facebook_url">Facebook URL</label>
                <div class="controls">
                    <input name="facebook_url" id="facebook_url" class="form-control" value="{{$record->facebook_url}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="twitter_url">Twitter URL</label>
                <div class="controls">
                    <input name="twitter_url" id="twitter_url" class="form-control" value="{{$record->twitter_url}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="linkedin_url">Linkedin URL</label>
                <div class="controls">
                    <input name="linkedin_url" id="linkedin_url" class="form-control" value="{{$record->linkedin_url}}"/>
                </div>
            </div>
            <div class="row form-group">
                <label for="tiktok_url">Tiktok URL</label>
                <div class="controls">
                    <input name="tiktok_url" id="tiktok_url" class="form-control" value="{{$record->tiktok_url}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="blog_url">Blog URL</label>
                <div class="controls">
                    <input name="blog_url" class="form-control" value="{{$record->blog_url}}" />
                </div>
            </div>


            <div class="row">
                <h3>Registration Questionnaire</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <ul id="regQuestions">
                </ul>
                <button id="addRegQuestionBtn" type="button" class="btn btn-info">Add Question</button>
            </div>


            <div class="row">
                <h3>Survey links</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="customer_satisfaction_survey_url">Customer satisfaction survey</label>
                <div class="controls">
                    <input type="text" name="customer_satisfaction_survey_url" class="form-control" id="customer_satisfaction_survey_url" value="{{$record->customer_satisfaction_survey_url }}" />
                </div>
            </div>

            <div class="row">
                <h3>Preferences</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <label for="app_logo">Default Region</label>
                <div class="controls">
                    <select name="default_region" class="form-control" id="default_region">
                        @foreach ($regions as $region)
                            @if ( $record->default_region == $region->id )
                                <option selected value="{{$region->id}}">{{$region->name}} ({{$region->code}})</option>
                            @else
                                <option value="{{$region->id}}">{{$region->name}} ({{$region->code}})</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="app_logo">Verification workflow</label>
                <div class="controls">
                    <select name="verification_workflow" class="form-control" id="verification_workflow">
                        @if ( $record->verification_workflow == 'sms')
                            <option value="sms" selected>SMS</option>
                            <option value="email">Email</option>
                        @elseif ( $record->verification_workflow == 'email')
                            <option value="sms">SMS</option>
                            <option value="email" selected>Email</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="mail_provider">SSO options</label>
                <div class="controls">
                    @if ( $record->enable_google_signin )
                        <input id="enable_google_signin" type="checkbox"  name="enable_google_signin" checked/>
                    @else
                        <input id="enable_google_signin" type="checkbox"  name="enable_google_signin"/>
                    @endif
                    <label>Enable Google</label>
                </div>
                <div class="controls">
                    @if ( $record->enable_msft_signin )
                        <input id="enable_msft_signin" type="checkbox"  name="enable_msft_signin" checked/>
                    @else
                        <input id="enable_msft_signin" type="checkbox"  name="enable_msft_signin"/>
                    @endif
                    <label>Enable Microsoft</label>
                </div>
                <div class="controls">
                    @if ( $record->enable_apple_signin )
                        <input id="enable_apple_signin" type="checkbox"  name="enable_apple_signin" checked/>
                    @else
                        <input id="enable_apple_signin" type="checkbox"  name="enable_apple_signin"/>
                    @endif
                    <label>Enable Apple</label>
                </div>
            </div>

            <div class="row form-group">
                <label for="mail_provider">Search options</label>
                <small>Please select any sections you want to add to the portal search results</small>
                <div class="controls">
                    @if ( $record->search_include_portal_views )
                        <input id="search_include_portal_views" type="checkbox"  name="search_include_portal_views" checked/>
                    @else
                        <input id="search_include_portal_views" type="checkbox"  name="search_include_portal_views"/>
                    @endif
                    <label>Portal pages</label>
                </div>
                <div class="controls">
                    @if ( $record->search_include_resources )
                        <input id="search_include_resources" type="checkbox"  name="search_include_resources" checked/>
                    @else
                        <input id="search_include_resources" type="checkbox"  name="search_include_resources"/>
                    @endif
                    <label>Resource articles</label>
                </div>
                <div class="controls">
                    @if ( $record->search_include_blog_views )
                        <input id="search_include_blog_views" type="checkbox"  name="search_include_blog_views" checked/>
                    @else
                        <input id="search_include_blog_views" type="checkbox"  name="search_include_blog_views"/>
                    @endif
                    <label>Blog posts</label>
                </div>
            </div>

            <div class="row">
                <h4>Content to display</h4>
                <hr/>
            </div>
            <div class="row form-group">
                <div class="controls">
                    @if ( $record->show_savings_content )
                        <input id="show_savings_content" type="checkbox"  name="show_savings_content" checked/>
                    @else
                        <input id="show_savings_content" type="checkbox"  name="show_savings_content"/>
                    @endif
                    <label>Price Savings</label>
                </div>
            </div>

            <div class="row form-group">
                <label for="payments_enabled">Payments enabled</label>
                <div class="controls">
                    <select name="payment_gateway_enabled" class="form-control" id="payment_gateway_enabled">
                        @if ( $record->payment_gateway_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

           <div class="row form-group">
                <label for="payment_gateway">Payment gateway</label>
                <div class="controls">
                    <select name="payment_gateway" class="form-control" id="payment_gateway">
                        @if ( $record->payment_gateway == 'stripe')
                            <option value="" selected>Select payment gateway</option>
                            <option value="stripe" selected>Stripe</option>
                        @else
                            <option value="">Select payment gateway</option>
                            <option value="stripe" selected>Stripe</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="live_chat_enabled">Live chat enabled</label>
                <div class="controls">
                    <select name="live_chat_enabled" class="form-control" id="live_chat_enabled">
                        @if ( $record->live_chat_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="live_chat_provider">Live chat provider</label>
                <div class="controls">
                    <select name="live_chat_provider" class="form-control" id="live_chat_provider">
                        @if ( $record->live_chat_provider == 'intercom')
                            <option value="">Select provider</option>
                            <option value="intercom" selected>Intercom</option>
                        @else
                            <option value="" selected>Select provider</option>
                            <option value="intercom">Intercom</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>


            <div class="row form-group">
                <label for="default_currency">Default billing currency</label>
                <div class="controls">
                    <select name="default_currency" class="form-control" id="default_currency">
                        @foreach ($currencies as $code => $currency)
                            @if ($code == $record->default_currency)
                                <option value="{{$code}}" selected>{{$currency}} ({{$code}})</option>
                            @else
                                <option value="{{$code}}">{{$currency}} ({{$code}})</option>
                            @endif
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="payments_enabled">Billing retry enabled</label>
                <div class="controls">
                    <select name="billing_retry_enabled" class="form-control" id="billing_retry_enabled">
                        @if ( $record->billing_retry_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label for="billing_retry_enabled">Billing retry attempts</label>
                <div class="controls">
                    <input name="billing_num_retries" class="form-control" id="billing_num_retries" value="{{$record->billing_num_retries}}"></input>
                </div>
            </div>


           <div class="row form-group">
                <label for="grace_period_billing_days">Grace period for overdue invoices (in days)</label>
                <div class="controls">
                    <input name="grace_period_billing_days" class="form-control" value="{{$record->grace_period_billing_days}}" />
                </div>
            </div>

            <div class="row form-group">
                <label for="register_credits_enabled">Register credits enabled</label>
                <div class="controls">
                    <select name="register_credits_enabled" class="form-control" id="register_credits_enabled">
                        @if ( $record->register_credits_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label for="register_credits">Register credits</label>
                <div class="controls">
                    <input name="register_credits" class="form-control" value="{{$record->register_credits}}" />
                </div>
            </div>


            <div class="row form-group">
                <label for="register_credits_enabled">Register credits enabled</label>
                <div class="controls">
                    <select name="register_credits_enabled" class="form-control" id="register_credits_enabled">
                        @if ( $record->register_credits_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="registration_questionnaire_enabled">Registeration questionnaire enabled</label>
                <div class="controls">
                    <select name="registration_questionnaire_enabled" class="form-control" id="registration_questionnaire_enabled">
                        @if ( $record->registration_questionnaire_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="customer_satisfaction_survey_enabled">Customer satisfaction survey enabled</label>
                <div class="controls">
                    <select name="customer_satisfaction_survey_enabled" class="form-control" id="customer_satisfaction_survey_enabled">
                        @if ( $record->customer_satisfaction_survey_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="zendesk_enabled">Support desk enabled (Zendesk integration)</label>
                <div class="controls">
                    <select name="zendesk_enabled" class="form-control" id="zendesk_enabled">
                        @if ( $record->zendesk_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>


            <div class="row form-group">
                <label for="portal_analytics_enabled">Portal Analytics enabled</label>
                <div class="controls">
                    <select name="portal_analytics_enabled" class="form-control" id="portal_analytics_enabled">
                        @if ( $record->portal_analytics_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label for="analytics_sdk">Analytics SDK</label>
                <div class="controls">
                    <select name="analytics_sdk" class="form-control" id="analytics_sdk">
                        @if ( $record->analytics_sdk == 'google')
                            <option value="google" selected>Google</option>
                            <option value="matomo">Matomo</option>
                        @elseif ( $record->analytics_sdk == 'matomo')
                            <option value="google">Google</option>
                            <option value="matomo" selected>Matomo</option>
                        @else ( $record->analytics_sdk == 'matomo')
                            <option value="google" selected>Google</option>
                            <option value="matomo">Matomo</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label for="sms_provider">SMS provider</label>
                <div class="controls">
                    <select name="sms_provider" class="form-control" id="sms_provider">
                        @if ( $record->sms_provider == 'd7networks')
                            <option value="d7networks" selected>D7Networks</option>
                            <option value="messagebird">Messagebird</option>
                            <option value="telerivet">Telerivet</option>
                        @elseif ( $record->sms_provider == 'messagebird')
                            <option value="d7networks">D7Networks</option>
                            <option value="messagebird" selected>Messagebird</option>
                            <option value="telerivet">Telerivet</option>
                        @elseif ( $record->sms_provider == 'telerivet')
                            <option value="d7networks">D7Networks</option>
                            <option value="messagebird">Messagebird</option>
                            <option value="telerivet" selected>Telerivet</option>
                        @else
                            <option value="d7networks">D7Networks</option>
                            <option value="messagebird">Messagebird</option>
                            <option value="telerivet">Telerivet</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

           <div class="row form-group">
                <label for="sms_api_key">SMS API key</label>
                <div class="controls">
                    <input name="sms_api_key" class="form-control" value="{{$record->sms_api_key}}" />
                </div>
            </div>

           <div class="row form-group">
                <label for="sms_api_secret">SMS API secret</label>
                <div class="controls">
                    <input name="sms_api_secret" class="form-control" value="{{$record->sms_api_secret}}" />
                </div>

            </div>

         <div class="row form-group">
                <label for="sms_from_number">SMS from number</label>
                <div class="controls">
                    <input name="sms_from_number" class="form-control" id="sms_from_number" value="{{$record->sms_from_number}}"/>
                </div>
            </div>

            <div class="row form-group">
                <label for="custom_code_containers_enabled">Allow users to run custom code</label>
                <small>note: this will create custom compute resources that allow users to compile and execute their custom code</small>
                <div class="controls">
                    <select name="custom_code_containers_enabled" class="form-control" id="custom_code_containers_enabled">
                        @if ( $record->custom_code_containers_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="signup_requires_payment_detail">Require payment details on registratione</label>
                <div class="controls">
                    <select name="signup_requires_payment_detail" class="form-control" id="signup_requires_payment_detail">
                        @if ( $record->signup_requires_payment_detail)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="recaptcha_enabled">ReCaptcha enabled</label>
                <div class="controls">
                    <select name="recaptcha_enabled" class="form-control" id="recaptcha_enabled">
                        @if ( $record->recaptcha_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="disqus_enabled">Disqus enabled</label>
                <div class="controls">
                    <select name="disqus_enabled" class="form-control" id="disqus_enabled">
                        @if ( $record->disqus_enabled)
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        @else
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="dns_provider">DNS provider</label>
                <small>note: if you are using the self managed option be sure to update the nameservers at your registrar to point to your deployment domain</small>
                <div class="controls">
                    <select name="dns_provider" class="form-control" id="dns_provider">
                        @if ( $record->dns_provider == 'namecheap')
                            <option value="namecheap" selected>Namecheap</option>
                            <option value="route53">Route53</option>
                            <option value="self-managed">Self managed</option>
                        @elseif ( $record->dns_provider == 'route53')
                            <option value="namecheap">Namecheap</option>
                            <option value="route53" selected>Route53</option>
                            <option value="self-managed">Self managed</option>
                        @elseif ( $record->dns_provider == 'self-managed')
                            <option value="namecheap">Namecheap</option>
                            <option value="route53">Route53</option>
                            <option value="self-managed" selected>Self managed</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="mail_provider">Mail provider</label>
                <div class="controls">
                    <select name="mail_provider" class="form-control" id="mail_provider">
                        @if ( $record->mail_provider == 'smtp-gateway')
                            <option value="smtp-gateway" selected>SMTP gateway</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <h3>App feedback settings</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <div class="controls">
                    @if ( $record->allow_app_feedback )
                        <input id="allow_app_feedback" type="checkbox"  name="allow_app_feedback" checked/>
                    @else
                        <input id="allow_app_feedback" type="checkbox"  name="allow_app_feedback"/>
                    @endif
                    <label>Allow app feedback</label>
                </div>
            </div>

            <div class="row form-group">
                <label for="feedback_platform">Feedback platform</label>
                <div class="controls">
                    <select name="feedback_platform" class="form-control" id="feedback_platform">
                        @foreach ($feedbackPlatforms as $platform)
                            @if ($platform == $record->feedback_platform)
                                <option value="{{$platform}}" selected>{{$platform}}</option>
                            @else
                                <option value="{{$platform}}">{{$platform}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="trustpilot_url">TrustPilot link</label>
                <div class="controls">
                    <input type="text" name="trustpilot_url" class="form-control" id="trustpilot_url" value="{{$record->trustpilot_url}}" />
                </div>
            </div>

            <div class="row form-group">
                <label for="g2_url">G2 Crowd link</label>
                <div class="controls">
                    <input type="text" name="g2_url" class="form-control" id="g2_url" value="{{$record->g2_url}}" />
                </div>
            </div>


            <div class="row">
                <h3>Billing settings</h3>
                <hr/>
            </div>


            <div class="row form-group">
                <label for="billing_frequency">Billing frequency</label>
                <br/>
                <small>note: this setting will be used to calculate total billing cost per call (outgoing or incoming). 
                Also, calls billed by the minute will be rounded up to the next minute. For example if you made a call for 3 minutes and 45 seconds it will automatically round up to 4 minutes total. 
                If you would like more precise billing it is suggested to bill calls by the second. </small>
                <div class="controls">
                    <select name="billing_frequency" class="form-control" id="billing_frequency">
                        @if ( $record->billing_frequency == 'PER_MINUTE')
                            <option value="PER_MINUTE" selected>Total minutes</option>
                            <option value="PER_SECOND">Total seconds</option>
                        @elseif ( $record->billing_frequency == 'PER_SECOND')
                            <option value="PER_MINUTE">Total minutes</option>
                            <option value="PER_SECOND" selected>Total seconds</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="maintenance_window_time">Maintenance window time</label>
                <div class="controls">
                    <select name="maintenance_window_time" class="form-control" id="maintenance_window_time">
                        @foreach ($maintenanceTimes as $time)
                            @if ($time == $record->maintenance_window_time)
                                <option value="{{$time}}" selected>{{$time}}</option>
                            @else
                                <option value="{{$time}}">{{$time}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="row">
                <h3>Maintenance and upgrade settings</h3>
                <hr/>
            </div>
            <div class="row form-group">
                <div class="controls">
                    @if ( $record->automatic_module_updates )
                        <input id="automatic_module_updates" type="checkbox"  name="automatic_module_updates" checked/>
                    @else
                        <input id="automatic_module_updates" type="checkbox"  name="automatic_module_updates"/>
                    @endif
                    <label>Automatic module updates</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="controls">
                    @if ( $record->automatic_security_updates )
                        <input id="automatic_security_updates" type="checkbox"  name="automatic_security_updates" checked/>
                    @else
                        <input id="automatic_security_updates" type="checkbox"  name="automatic_security_updates"/>
                    @endif
                    <label>Automatic security updates</label>
                </div>
            </div>

            <div class="row form-group">
                <label for="maintenance_window_day">Maintenance window day</label>
                <div class="controls">
                    <select name="maintenance_window_day" class="form-control" id="maintenance_window_day">
                        @foreach ($maintenanceDays as $day)
                            @if ($day == $record->maintenance_window_day)
                                <option value="{{$day}}" selected>{{$day}}</option>
                            @else
                                <option value="{{$day}}">{{$day}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="maintenance_window_time">Maintenance window time</label>
                <div class="controls">
                    <select name="maintenance_window_time" class="form-control" id="maintenance_window_time">
                        @foreach ($maintenanceTimes as $time)
                            @if ($time == $record->maintenance_window_time)
                                <option value="{{$time}}" selected>{{$time}}</option>
                            @else
                                <option value="{{$time}}">{{$time}}</option>
                            @endif
                        @endforeach
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
<script>

var questionnaire = {!! json_encode( $questionnaire ) !!};
function createKey(count, name) {
    return "questionnaire[" + count + "]" + "[" + name + "]";
}

function addQuestion(data) {
    var container= $("#regQuestions");
    var count = $("#regQuestions li").length;
    var li = $("<li></li>");
    li.attr("class", "list-unstyled");
    var field = $("<input type='text' class='form-control'/>")
    var fieldName = createKey(count, "question");
    field.attr("name", fieldName);
    if (data) {
        field.val( data.question );
        var idField = $("<input type='hidden'/>");
        var idKey = createKey( count, "id" );
        idField.attr("name", idKey);
        idField.val(data.id);
        idField.appendTo( li );
    }
    field.appendTo( li );
    var deleteBtn = $("<a class='delete cursor-pointer'>(Delete)</a>");
    deleteBtn.click(function() {
        $( li ).remove().end();
    });

    deleteBtn.appendTo( li );
    li.appendTo( container );
}
$("#addRegQuestionBtn").click(function() {
    addQuestion();
 
});

questionnaire.forEach((item) => {

    addQuestion(item);
});
</script>
@endsection

