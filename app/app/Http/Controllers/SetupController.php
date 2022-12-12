<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ApiCredential;
use App\User;
function getSavedValue($request, $creds,  $key) {
  $submitted = @$_POST[ $key ];
  if (empty($submitted)) {
    $fallback = $creds->$key;
    return $fallback;
  }
  return $submitted;
}
class SetupController extends BaseController {
  public function setup()
  {
    return view("setup.intro");
  }

  private function save_settings($params, $data) {
    $creds = ApiCredential::getRecord();
    $update = [];
    foreach ( $params as $item ) {
      $update[ $item ] = $data[ $item ];
    }
    $creds->update( $update );
  }
  public function setup_storage(Request $request)
  {
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
    $aws_access_key_id = getSavedValue($request, $creds,  'aws_access_key_id');
    $aws_secret_access_key = getSavedValue($request, $creds,  'aws_secret_access_key');
    $selected_region = getSavedValue($request, $creds,  'aws_region');
    $provider = getSavedValue($request, $creds,  'storage_provider');

    $params = [
      'aws_regions' => $aws_regions,
      'aws_access_key_id' => $aws_access_key_id,
      'aws_secret_access_key' => $aws_secret_access_key,
      'selected_region' => $selected_region,
      'storage_provider' => $provider
    ];
  
    return view("setup.storage", $params);
  }
  public function save_storage(Request $request)
  {
    $creds = ApiCredential::getRecord();
     $params = [
        'aws_access_key_id',
        'aws_secret_access_key',
        'aws_region',
        'storage_provider'
     ];
    $creds = ApiCredential::getRecord();
    $this->save_settings($params,$request->all());
    return redirect("/setup/tts");
  }

  public function setup_tts(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $google_service_account_json = getSavedValue($request, $creds,  'google_service_account_json');
    $provider = getSavedValue($request, $creds,  'tts_provider');
    $params = [
      'google_service_account_json' => $google_service_account_json,
      'tts_provider' => $provider
    ];
  
    return view("setup.tts", $params);
  }
  public function save_tts(Request $request)
  {
    $creds = ApiCredential::getRecord();
     $params = [
'google_service_account_json',
'tts_provider'
     ];
    $creds = ApiCredential::getRecord();
    $this->save_settings($params,$request->all());
    return redirect("/setup/payments");
  }

  public function setup_payments(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $stripe_pub_key = getSavedValue($request, $creds,  'stripe_pub_key');
    $stripe_private_key = getSavedValue($request, $creds,  'stripe_private_key');
    $stripe_test_pub_key = getSavedValue($request, $creds,  'stripe_test_pub_key');
    $stripe_test_private_key = getSavedValue($request, $creds,  'stripe_test_private_key');


    $params = [
      'stripe_pub_key' => $stripe_pub_key,
      'stripe_private_key' => $stripe_private_key,
      'stripe_test_pub_key' => $stripe_pub_key,
      'stripe_test_private_key' => $stripe_private_key,
    ];
  
    return view("setup.payments", $params);
  }
  public function save_payments(Request $request)
  {
    $creds = ApiCredential::getRecord();
     $params = [
      'stripe_pub_key',
      'stripe_private_key',
      'stripe_test_pub_key',
      'stripe_test_private_key'
     ];
    $creds = ApiCredential::getRecord();
    $this->save_settings($params,$request->all());
    return redirect("/setup/smtp");
  }
  public function setup_smtp(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $smtp_host= getSavedValue($request, $creds,  'smtp_host');
    $smtp_user= getSavedValue($request, $creds,  'smtp_user');
    $smtp_password= getSavedValue($request, $creds,  'smtp_password');
    $smtp_tls= getSavedValue($request, $creds,  'smtp_tls');
    $params = [
      'smtp_host' => $smtp_host,
      'smtp_user' => $smtp_user,
      'smtp_password' => $smtp_password,
      'smtp_tls' => $smtp_tls
    ];
  
    return view("setup.smtp", $params);
  }
  public function save_smtp(Request $request)
  {

    $params = [
      'smtp_host',
      'smtp_user',
      'smtp_password',
      'smtp_tls'
    ];
    $creds = ApiCredential::getRecord();
    $this->save_settings($params,$request->all());
    return redirect("/setup/admin");
  }
  public function save(Request $request)
  {
    $input = $request->all();
    $settings = ApiCredential::getRecord();
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
    $settings->update($update);
    $session = $req->session();
    $session->flash('type', 'success');
    $session->flash('message', 'Settings saved successfully..');
    return response("OK");
  }


  public function setup_admin(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $user = User::getAdminRecord();
    $admin_email= getSavedValue($request, $user,  'email');
    $params = [
      'email' => $admin_email
    ];
  
    return view("setup.admin", $params);
  }
  public function save_admin(Request $request)
  {
    $data = $request->all();

    $session = $request->session();
    $creds = ApiCredential::getRecord();
    if ( $data['admin_password'] != $data['admin_cpassword']) {
      $session->flash('type', 'danger');
      $session->flash('message', 'Password did not match');
    $admin_email= getSavedValue($request, $creds,  'email');
    $admin_password= getSavedValue($request, $creds,  'admin_password');
    $params = [
      'email' => $admin_email,
      'admin_password' => $admin_password
    ];
      return view("setup.admin", $params);
    }
    $admin = User::getAdminRecord();
    $admin->update([
      'email' =>  $data['email'],
      'password' =>  bcrypt($data['admin_password']),
    ]);
    return redirect("/setup/customization");
  }


  public function setup_customization(Request $request)
  {
    return view("setup.customization", $params);
  }
  public function save_customization(Request $request)
  {
    $data = $request->all();
    return redirect("/setup/complete");
  }
public function setup_complete(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $creds->update([
      'setup_complete' => TRUE
    ]);
    return view('setup.complete');
  }
public function setup_alreadycomplete(Request $request)
  {
    return view('setup.alreadycomplete');
  }
public function setup_restart(Request $request)
  {
    $creds = ApiCredential::getRecord();
    $creds->update([
      'setup_complete' => FALSE
    ]);
    return redirect("/setup/");
  }

}