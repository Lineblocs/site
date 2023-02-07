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

            <div class="row">
                <h3>Preferences</h3>
                <hr/>
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
                            <option value="stripe" selected>Stripe</option>
                        @endif
                        <!--<option>Wide</option>-->
                        <!--<option>Compact</option>-->
                    </select>
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
