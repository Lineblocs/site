<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ApiCredential;

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
  public function setup_storage()
  {
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
    $aws_access_key_id = @$_POST['aws_access_key_id'];
    $aws_secret_access_key = @$_POST['aws_secret_access_key'];
    $selected_region = @$_POST['aws_region'];
    $provider = @$_POST['storage_provider'];

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

  public function setup_tts()
  {
    $google_service_account_json = @$_POST['google_service_account_json'];
    $provider = @$_POST['tts_provider'];
    $params = [
      'google_service_account_json' => $google_service_account_json,
      'tts_provider' => $provider
    ];
  
    return view("setup.tts", $params);
  }
  public function save_tts(Request $request)
  {
     $params = [
'google_service_account_json',
'tts_provider'
     ];
    $creds = ApiCredential::getRecord();
    $this->save_settings($params,$request->all());
    return redirect("/setup/payments");
  }

  public function setup_payments()
  {
    $stripe_pub_key = @$_POST['stripe_pub_key'];
    $stripe_private_key = @$_POST['stripe_private_key'];
    $stripe_test_pub_key = @$_POST['stripe_test_pub_key'];
    $stripe_test_private_key = @$_POST['stripe_test_private_key'];


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
  public function setup_smtp()
  {
    $smtp_host= @$_POST['smtp_host'];
    $smtp_user= @$_POST['smtp_user'];
    $smtp_password= @$_POST['smtp_password'];
    $smtp_tls= @$_POST['smtp_tls'];
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
    return redirect("/setup/complete");
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
public function setup_complete(Request $request)
  {
    return view('setup.complete');
  }

}