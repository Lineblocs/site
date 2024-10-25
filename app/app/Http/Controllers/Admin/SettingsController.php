<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ApiCredential;
use App\ApiCredentialGroup2;
use App\ApiCredentialKVStore;
use Illuminate\Http\Request;

class SettingsController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function view()
	{
        $title = "Settings";
        $creds = ApiCredentialKVStore::getRecord();

        $aws_regions = array( 
            "us-east-1" => "US East (N. Virginia)",
            "us-west-2" => "US West (Oregon)",
            "us-west-1" => "US West (N. California)",
            "ca-central-1" => "Canada Central",
            "eu-west-1" => "EU (Ireland)",
            "eu-central-1" => "EU (Frankfurt)",
            "ap-southeast-1" => "Asia Pacific (Singapore)",
            "ap-northeast-1" => "Asia Pacific (Tokyo)",
            "ap-southeast-2" => "Asia Pacific (Sydney)",
            "ap-northeast-2" => "Asia Pacific (Seoul)",
            "sa-east-1" => "South America (São Paulo)",
            "cn-north-1" => "China (Beijing)",
            "ap-south-1" => "India (Mumbai)"
        );
        if ( empty( $creds->aws_region )){
            $region_keys = array_keys( $aws_regions );
            $selected_region = $region_keys[0];
        } else {
            $selected_region = $creds->aws_region;
        }
		return view('admin.settings.view',  compact('creds','aws_regions', 'selected_region'));
	}
	public function save(Request $req)
	{
        $data = $req->all();
        $title = "Settings";
        $creds = ApiCredentialKVStore::getRecord();
        $keys = [
        'aws_access_key_id',
        'aws_secret_access_key',
        'aws_region',
        's3_bucket',
        'google_service_account_json',
        'stripe_pub_key',
        'stripe_private_key',
        'stripe_test_pub_key',
        'stripe_test_private_key',
        'stripe_mode',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'smtp_tls',
        'google_signin_developer_key',
        'google_signin_client_id',
        'google_signin_app_id',
        'msft_signin_client_id',
        'msft_signin_client_secret',
        'apple_signin_client_id',
        'apple_signin_client_secret',
        'google_signin_app_id',
        'google_analytics_script_tag',
        'matomo_script_tag',
        'sentry_dsn',
        'telerivet_api_key',
        'telerivet_project_id',
        'whatsapp_phone_number_id',
        'whatsapp_access_token',
        'recaptcha_sitekey',
        'recaptcha_privatekey',
        'disqus_site',
        'zendesk_subdomain',
        'zendesk_username',
        'zendesk_token',
        'intercom_workspace_id',
        'namecheap_api_key',
        'namecheap_api_user',
        'paypal_api_mode',
        'paypal_live_client_id',
        'paypal_live_client_secret',
        'paypal_test_client_id',
        'paypal_test_client_secret',
        ];

        $update = [];
        foreach ( $keys as $key ) {
            $update[ $key ] = $data[ $key ];
            ApiCredentialKVStore::upsert($key, 'string_value', $data[$key]);
        }

        $session = $req->session();
        $session->flash('type', 'success');
        $session->flash('message', 'Settings saved successfully..');
        return redirect("/admin/settings");
	}
}