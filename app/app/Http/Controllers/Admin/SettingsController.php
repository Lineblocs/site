<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ApiCredential;
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
        $creds = ApiCredential::getRecord();
        $aws_regions = array( 
            "us-east-1" => "US East (N. Virginia)",
            "us-west-2" => "US West (Oregon)",
            "us-west-1" => "US West (N. California)",
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
            $selected_region = $aws_regions[0];
        } else {
            $selected_region = $creds->aws_region;
        }
		return view('admin.settings.view',  compact('creds', 'aws_regions', 'selected_region'));
	}
	public function save(Request $req)
	{
        $data = $req->all();
        $title = "Settings";
        $creds = ApiCredential::getRecord();
        $keys = [
        'aws_access_key_id',
        'aws_secret_access_key',
        'aws_region',
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
        'smtp_tls'
        ];
        $update = [];
        foreach ( $keys as $key ) {
            $update[ $key ] = $data[ $key ];
        }
        $creds->update($update);
        $session = $req->session();
        $session->flash('type', 'success');
        $session->flash('message', 'Settings saved successfully..');
        return redirect("/admin/settings");
	}
}