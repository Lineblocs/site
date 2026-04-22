<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiCredentialKVStore;
use App\User;
use Validator;
use Schema;
use Carbon\Carbon;

function getSavedValue($request, $creds, $key) {
  $submitted = $request->old($key);
  if (is_null($submitted)) {
    $submitted = $request->input($key);
  }
  if (!is_null($submitted) && $submitted !== '') {
    return $submitted;
  }
  if (isset($creds) && isset($creds->$key) && !is_null($creds->$key) && $creds->$key !== '') {
    return $creds->$key;
  }
  return '';
}

function getEnvValue($keys, $fallback = '') {
  foreach ($keys as $key) {
    $value = env($key);
    if (!is_null($value) && $value !== '') {
      return $value;
    }
  }
  return $fallback;
}

class SetupController extends BaseController {
  private function withStepState($params, $step) {
    $params['setup_step'] = $step;
    return $params;
  }

  private function validateStep(Request $request, $rules, $messages = []) {
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput()
        ->with('type', 'danger')
        ->with('message', $validator->errors()->first());
    }
    return null;
  }

  private function saveSettingValue($key, $value) {
    if (is_bool($value)) {
      return ApiCredentialKVStore::upsert($key, 'boolean_value', $value ? 1 : 0);
    }
    if (is_int($value)) {
      return ApiCredentialKVStore::upsert($key, 'number_value', $value);
    }
    return ApiCredentialKVStore::upsert($key, 'string_value', (string)$value);
  }

  private function setSetupCurrentStep($step) {
    $this->saveSettingValue('setup_current_step', (int)$step);
  }

  private function setSetupComplete($isComplete) {
    $this->saveSettingValue('setup_complete', (bool)$isComplete);
  }

  private function setSetupCompletedAt($timestamp) {
    $this->saveSettingValue('setup_completed_at', (string)$timestamp);
  }

  private function save_settings($params, $data) {
    foreach ($params as $item) {
      $value = isset($data[$item]) ? $data[$item] : '';
      $this->saveSettingValue($item, $value);
    }
  }

  private function ensureAdminUser($email = null, $password = null) {
    $admin = User::where('admin', '1')->first();

    if (!$admin) {
      $admin = User::orderBy('id', 'asc')->first();
      if ($admin) {
        $admin->admin = 1;
        if (!empty($email)) {
          $admin->email = $email;
        }
        if (!empty($password)) {
          $admin->password = bcrypt($password);
        }
        $admin->save();
        return $admin;
      }
    }

    if (!$admin) {
      $generatedEmail = !empty($email) ? $email : getEnvValue(['ADMIN_EMAIL', 'MAIL_FROM_ADDRESS'], 'admin@localhost.local');
      $username = strstr($generatedEmail, '@', true);
      if ($username === false || $username === '') {
        $username = 'admin';
      }

      $payload = [
        'name' => 'Administrator',
        'username' => $username . '_' . time(),
        'email' => $generatedEmail,
        'password' => bcrypt(!empty($password) ? $password : 'ChangeMe123!'),
        'confirmation_code' => str_random(40),
        'confirmed' => 1,
        'admin' => 1,
      ];

      if (Schema::hasColumn('users', 'first_name')) {
        $payload['first_name'] = 'Setup';
      }
      if (Schema::hasColumn('users', 'last_name')) {
        $payload['last_name'] = 'Admin';
      }
      if (Schema::hasColumn('users', 'company_name')) {
        $payload['company_name'] = getEnvValue(['APP_NAME'], 'Lineblocs');
      }

      $admin = User::create($payload);
    }

    return $admin;
  }

  public function setup() {
    $creds = ApiCredentialKVStore::getRecord();
    $currentStep = (int)$creds->setup_current_step;
    if ($currentStep < 1) {
      $this->setSetupCurrentStep(1);
    }
    return view('setup.intro', $this->withStepState([], 0));
  }

  public function setup_storage(Request $request) {
    $creds = ApiCredentialKVStore::getRecord();
    $aws_regions = [
      'us-east-1' => 'US East (N. Virginia)',
      'us-west-2' => 'US West (Oregon)',
      'us-west-1' => 'US West (N. California)',
      'eu-west-1' => 'EU (Ireland)',
      'eu-central-1' => 'EU (Frankfurt)',
      'ap-southeast-1' => 'Asia Pacific (Singapore)',
      'ap-northeast-1' => 'Asia Pacific (Tokyo)',
      'ap-southeast-2' => 'Asia Pacific (Sydney)',
      'ap-northeast-2' => 'Asia Pacific (Seoul)',
      'sa-east-1' => 'South America (São Paulo)',
      'cn-north-1' => 'China (Beijing)',
      'ap-south-1' => 'India (Mumbai)'
    ];

    $aws_access_key_id = getSavedValue($request, $creds, 'aws_access_key_id');
    $aws_secret_access_key = getSavedValue($request, $creds, 'aws_secret_access_key');
    $selected_region = getSavedValue($request, $creds, 'aws_region');
    $provider = getSavedValue($request, $creds, 'storage_provider');

    if (empty($aws_access_key_id)) {
      $aws_access_key_id = getEnvValue(['AWS_ACCESS_KEY_ID']);
    }
    if (empty($aws_secret_access_key)) {
      $aws_secret_access_key = getEnvValue(['AWS_SECRET_ACCESS_KEY']);
    }
    if (empty($selected_region)) {
      $selected_region = getEnvValue(['AWS_DEFAULT_REGION', 'AWS_REGION'], 'us-east-1');
    }
    if (empty($provider)) {
      $provider = getEnvValue(['STORAGE_PROVIDER'], 'aws');
    }

    $params = $this->withStepState([
      'aws_regions' => $aws_regions,
      'aws_access_key_id' => $aws_access_key_id,
      'aws_secret_access_key' => $aws_secret_access_key,
      'selected_region' => $selected_region,
      'storage_provider' => $provider
    ], 1);

    return view('setup.storage', $params);
  }

  public function save_storage(Request $request) {
    $regions = [
      'us-east-1','us-west-2','us-west-1','eu-west-1','eu-central-1','ap-southeast-1',
      'ap-northeast-1','ap-southeast-2','ap-northeast-2','sa-east-1','cn-north-1','ap-south-1'
    ];

    $validation = $this->validateStep($request, [
      'storage_provider' => 'required|in:aws',
      'aws_access_key_id' => 'required|min:10|max:128',
      'aws_secret_access_key' => 'required|min:16|max:128',
      'aws_region' => 'required|in:' . implode(',', $regions),
    ], [
      'storage_provider.in' => 'Only Amazon S3 is supported in this installer right now.',
      'aws_access_key_id.required' => 'Enter an AWS Access Key ID so recordings and media can be stored.',
      'aws_secret_access_key.required' => 'Enter an AWS Secret Access Key to authenticate storage uploads.',
      'aws_region.in' => 'Select a valid AWS region from the list.',
    ]);
    if ($validation) {
      return $validation;
    }

    $this->save_settings([
      'aws_access_key_id',
      'aws_secret_access_key',
      'aws_region',
      'storage_provider'
    ], $request->all());

    $this->setSetupCurrentStep(2);

    return redirect('/setup/tts')
      ->with('type', 'success')
      ->with('message', 'Storage settings saved. Next: text-to-speech provider.');
  }

  public function setup_tts(Request $request) {
    $creds = ApiCredentialKVStore::getRecord();
    $google_service_account_json = getSavedValue($request, $creds, 'google_service_account_json');
    $provider = getSavedValue($request, $creds, 'tts_provider');

    if (empty($google_service_account_json)) {
      $google_service_account_json = getEnvValue(['GOOGLE_SERVICE_ACCOUNT_JSON', 'GOOGLE_APPLICATION_CREDENTIALS_JSON']);
    }
    if (empty($provider)) {
      $provider = getEnvValue(['TTS_PROVIDER'], 'aws');
    }

    $params = $this->withStepState([
      'google_service_account_json' => $google_service_account_json,
      'tts_provider' => $provider
    ], 2);

    return view('setup.tts', $params);
  }

  public function save_tts(Request $request) {
    $validation = $this->validateStep($request, [
      'tts_provider' => 'required',
      'google_service_account_json' => 'required',
    ], [
      'google_service_account_json.required' => 'Paste your Google service account JSON so TTS prompts can be generated.',
    ]);
    if ($validation) {
      return $validation;
    }

    $rawGoogleJson = trim((string)$request->input('google_service_account_json'));
    $json = json_decode($rawGoogleJson, true);

    if (!is_array($json) && is_file($rawGoogleJson) && is_readable($rawGoogleJson)) {
      $fileContents = file_get_contents($rawGoogleJson);
      $json = json_decode($fileContents, true);
      if (is_array($json)) {
        $request->merge([
          'google_service_account_json' => $fileContents
        ]);
      }
    }

    if (!is_array($json)) {
      return redirect()->back()
        ->withInput()
        ->with('type', 'danger')
        ->with('message', 'Invalid Google service account value. Paste the full JSON content or provide a readable JSON file path.');
    }

    $missingKeys = [];
    foreach (['client_email', 'private_key'] as $requiredKey) {
      if (empty($json[$requiredKey])) {
        $missingKeys[] = $requiredKey;
      }
    }
    // if (!empty($missingKeys)) {
    //   return redirect()->back()
    //     ->withInput()
    //     ->with('type', 'danger')
    //     ->with('message', 'Google key is missing required fields: ' . implode(', ', $missingKeys) . '.');
    // }

    $this->save_settings([
      'google_service_account_json',
      'tts_provider'
    ], $request->all());

    $this->setSetupCurrentStep(3);

    return redirect('/setup/payments')
      ->with('type', 'success')
      ->with('message', 'TTS settings saved. Next: billing configuration.');
  }

  public function setup_payments(Request $request) {
    $creds = ApiCredentialKVStore::getRecord();

    $stripe_pub_key = getSavedValue($request, $creds, 'stripe_pub_key');
    $stripe_private_key = getSavedValue($request, $creds, 'stripe_private_key');
    $stripe_test_pub_key = getSavedValue($request, $creds, 'stripe_test_pub_key');
    $stripe_test_private_key = getSavedValue($request, $creds, 'stripe_test_private_key');

    if (empty($stripe_pub_key)) {
      $stripe_pub_key = getEnvValue(['STRIPE_KEY', 'STRIPE_PUBLIC_KEY']);
    }
    if (empty($stripe_private_key)) {
      $stripe_private_key = getEnvValue(['STRIPE_SECRET', 'STRIPE_PRIVATE_KEY']);
    }
    if (empty($stripe_test_pub_key)) {
      $stripe_test_pub_key = getEnvValue(['STRIPE_TEST_KEY', 'STRIPE_TEST_PUBLIC_KEY']);
    }
    if (empty($stripe_test_private_key)) {
      $stripe_test_private_key = getEnvValue(['STRIPE_TEST_SECRET', 'STRIPE_TEST_PRIVATE_KEY']);
    }

    $params = $this->withStepState([
      'stripe_pub_key' => $stripe_pub_key,
      'stripe_private_key' => $stripe_private_key,
      'stripe_test_pub_key' => $stripe_test_pub_key,
      'stripe_test_private_key' => $stripe_test_private_key,
    ], 3);

    return view('setup.payments', $params);
  }

  public function save_payments(Request $request) {
    $validation = $this->validateStep($request, [
      'stripe_private_key' => 'required',
      'stripe_pub_key' => 'required',
      'stripe_test_private_key' => 'required',
      'stripe_test_pub_key' => 'required',
    ], [
      'stripe_private_key.required' => 'Enter your live Stripe secret key (starts with sk_live_).',
      'stripe_pub_key.required' => 'Enter your live Stripe publishable key (starts with pk_live_).',
      'stripe_test_private_key.required' => 'Enter your Stripe test secret key for safe smoke testing.',
      'stripe_test_pub_key.required' => 'Enter your Stripe test publishable key for frontend checks.',
    ]);
    if ($validation) {
      return $validation;
    }

    $this->save_settings([
      'stripe_pub_key',
      'stripe_private_key',
      'stripe_test_pub_key',
      'stripe_test_private_key'
    ], $request->all());

    $this->setSetupCurrentStep(4);

    return redirect('/setup/smtp')
      ->with('type', 'success')
      ->with('message', 'Stripe settings saved. Next: email delivery.');
  }

  public function setup_smtp(Request $request) {
    $creds = ApiCredentialKVStore::getRecord();

    $smtp_host = getSavedValue($request, $creds, 'smtp_host');
    $smtp_port = getSavedValue($request, $creds, 'smtp_port');
    $smtp_user = getSavedValue($request, $creds, 'smtp_user');
    $smtp_password = getSavedValue($request, $creds, 'smtp_password');
    $smtp_tls = getSavedValue($request, $creds, 'smtp_tls');

    if (empty($smtp_host)) {
      $smtp_host = getEnvValue(['MAIL_HOST', 'SMTP_HOST']);
    }
    if (empty($smtp_user)) {
      $smtp_user = getEnvValue(['MAIL_USERNAME', 'SMTP_USER']);
    }
    if (empty($smtp_port)) {
      $smtp_port = getEnvValue(['MAIL_PORT', 'SMTP_PORT'], '587');
    }
    if (empty($smtp_password)) {
      $smtp_password = getEnvValue(['MAIL_PASSWORD', 'SMTP_PASSWORD']);
    }
    if ($smtp_tls === '') {
      $smtp_tls = getEnvValue(['MAIL_ENCRYPTION'], 'tls') === 'tls' ? '1' : '0';
    }

    $params = $this->withStepState([
      'smtp_host' => $smtp_host,
      'smtp_port' => $smtp_port,
      'smtp_user' => $smtp_user,
      'smtp_password' => $smtp_password,
      'smtp_tls' => $smtp_tls
    ], 4);

    return view('setup.smtp', $params);
  }

  public function save_smtp(Request $request) {
    $validation = $this->validateStep($request, [
      'smtp_host' => 'required',
      'smtp_port' => 'required|integer|between:1,65535',
      'smtp_user' => 'required',
      'smtp_password' => 'required',
      'smtp_tls' => 'required|in:0,1',
    ], [
      'smtp_host.required' => 'Enter your SMTP server host, for example smtp.mailgun.org.',
      'smtp_port.required' => 'Enter your SMTP server port, for example 587.',
      'smtp_port.integer' => 'SMTP port must be a valid number.',
      'smtp_port.between' => 'SMTP port must be between 1 and 65535.',
      'smtp_user.required' => 'Enter the SMTP username used for authentication.',
      'smtp_password.required' => 'Enter the SMTP password or app-specific token.',
      'smtp_tls.in' => 'Select whether TLS is enabled for your SMTP transport.',
    ]);
    if ($validation) {
      return $validation;
    }

    $this->save_settings([
      'smtp_host',
      'smtp_port',
      'smtp_user',
      'smtp_password',
      'smtp_tls'
    ], $request->all());

    $this->setSetupCurrentStep(5);

    return redirect('/setup/admin')
      ->with('type', 'success')
      ->with('message', 'SMTP settings saved. Next: create your admin account.');
  }

  public function setup_admin(Request $request) {
    $user = $this->ensureAdminUser();
    $admin_email = getSavedValue($request, $user, 'email');
    if (empty($admin_email)) {
      $admin_email = getEnvValue(['ADMIN_EMAIL', 'MAIL_FROM_ADDRESS']);
    }

    $params = $this->withStepState([
      'email' => $admin_email
    ], 5);

    return view('setup.admin', $params);
  }

  public function save_admin(Request $request) {
    $data = $request->all();

    $validation = $this->validateStep($request, [
      'email' => 'required|email',
      'admin_password' => [
        'required',
        'min:10',
        'max:128',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).+$/'
      ],
      'admin_cpassword' => 'required|same:admin_password',
    ], [
      'email.required' => 'Enter an admin email that can receive recovery and security notices.',
      'email.email' => 'Enter a valid email address for the admin account.',
      'admin_password.min' => 'Use at least 10 characters for better account security.',
      'admin_password.regex' => 'Use a strong password with uppercase, lowercase, number, and special character.',
      'admin_cpassword.required' => 'Re-enter the password to confirm it before continuing.',
      'admin_cpassword.same' => 'Passwords do not match. Re-enter both fields and try again.',
    ]);
    if ($validation) {
      return $validation;
    }

    $admin = $this->ensureAdminUser($data['email'], $data['admin_password']);
    $admin->update([
      'email' => $data['email'],
      'password' => bcrypt($data['admin_password']),
      'admin' => 1,
      'confirmed' => 1,
    ]);

    $this->setSetupCurrentStep(6);

    return redirect('/setup/customization')
      ->with('type', 'success')
      ->with('message', 'Administrator account saved. Next: workspace branding.');
  }

  public function setup_customization(Request $request) {
    $user = $this->ensureAdminUser();
    $name = getSavedValue($request, $user, 'company_name');
    if (empty($name)) {
      $name = getEnvValue(['APP_NAME'], 'Lineblocs');
    }

    $params = $this->withStepState([
      'name' => $name
    ], 6);

    return view('setup.customization', $params);
  }

  public function save_customization(Request $request) {
    $validation = $this->validateStep($request, [
      'name' => 'required|min:2|max:120'
    ], [
      'name.required' => 'Enter your company or workspace name to complete onboarding.',
      'name.min' => 'Company name is too short. Use at least 2 characters.',
    ]);
    if ($validation) {
      return $validation;
    }

    $admin = $this->ensureAdminUser();
    $admin->update([
      'company_name' => $request->input('name')
    ]);

    $this->setSetupCurrentStep(7);

    return redirect('/setup/complete')
      ->with('type', 'success')
      ->with('message', 'Branding saved. Finalizing setup...');
  }

  public function setup_complete(Request $request) {
    $this->setSetupComplete(TRUE);
    $this->setSetupCompletedAt(Carbon::now()->format('Y-m-d H:i:s'));
    $this->setSetupCurrentStep(7);
    return view('setup.complete', $this->withStepState([], 7));
  }

  public function setup_alreadycomplete(Request $request) {
    return view('setup.alreadycomplete', $this->withStepState([], 7));
  }

  public function setup_restart(Request $request) {
    $this->setSetupComplete(FALSE);
    $this->setSetupCompletedAt('');
    $this->setSetupCurrentStep(1);
    return redirect('/setup/storage');
  }
}
