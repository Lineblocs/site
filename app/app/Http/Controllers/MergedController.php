<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Call;
use App\UserCard;
use App\UsageTrigger;
use App\DIDNumber;
use App\ServicePlan;
use App\CallSystemTemplate;
use App\Workspace;
use App\WorkspaceEvent;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPTrunk;
use App\BillingCountry;
use App\BillingRegion;
use App\PhoneDefault;
use App\RegistrationQuestionnaire;
use App\RegistrationResponse;
use App\Fax;
use App\PlanUsagePeriod;
use App\Extension;
use App\File;
use App\Flow;
use App\Recording;
use App\IpWhitelist;
use App\BlockedNumber;
use App\VerifiedCallerId;
use App\BYOCarrier;
use App\BYODIDNumber;

use App\Customizations;
use App\ApiCredential;
use App\Phone;

use App\PhoneGroup;
use App\WorkspaceUser;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\EmailHelper;
use App\Helpers\AWSHelper;
use App\Helpers\DNSHelper;
use App\Helpers\PhoneProvisionHelper;
use App\Helpers\BillingDataHelper;

use App\Helpers\PortalSearchHelper;
use App\Helpers\SMSHelper;

use App\PhoneGlobalSetting;
use App\PhoneGlobalSettingValue;
use App\PhoneIndividualSetting;
use App\PhoneIndividualSettingValue;
use App\FlowTemplate;
use App\FlowTemplatePreset;
use App\WorkspaceInvite;

use \Config;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use OTPHP\TOTP;
use OTPHP\TOTPInterface;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer as QRWriter;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\UserCredit;
use DateTime;
use DateInterval;
use DB;

class MergedController extends ApiAuthController
{

    public function verifyPasswordStrength(Request $request) {
        $password = $request->json()->all()['password'];
        if (strlen($password) < 8) {
          return $this->response->array([
            'success' => FALSE,
            'validationError' => 'Length must be 8 or more characters'
          ]);
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
          return $this->response->array([
            'success' => FALSE,
            'validationError' => 'Must contain 1 number'
          ]);

        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            return $this->response->array([
            'success' => FALSE,
            'validationError' => 'Must contain 1 capital letter'
          ]);

        }
        elseif(!preg_match("#[a-z]+#",$password)) {
          return $this->response->array([
            'success' => FALSE,
            'validationError' => 'Must contain 1 lowercase letter'
          ]);

        }
        elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            return $this->response->array([
            'success' => FALSE,
            'validationError' => 'Must contain 1 special character'
          ]);

        }
        return $this->response->array([
            'success' => TRUE
          ]);

    }
    public function generateSecurePassword(Request $request) {
        $password = MainHelper::randomPassword();
        return $this->response->array([
            'password' => $password
          ]);

    }
    public function getBillingHistory(Request $request)
    {
      $user = $this->getUser($request);
      $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));      $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));
      return $this->response->array($data);

    }
    public function changeBillingSettings(Request $request)
    {
      $user = $this->getUser($request);
        $update = $request->only(['auto_recharge', 'auto_recharge_top_up']);
        $user->update( $update );
        return $this->response->noContent();
    }
    public function getCallSystemTemplates()
    {
      $templates = CallSystemTemplate::get()->toArray();
      return $this->response->array($templates);
    }
    public function getWorkspaceTokens(Request $request)
    {
      $workspace = $this->getWorkspace($request);
      return $this->response->array(array(
        'api_token' => $workspace->api_token,
        'api_secret' => $workspace->api_secret
      ));
    }
    public function refreshWorkspaceTokens(Request $request)
    {
      $workspace = $this->getWorkspace($request);
      $workspace->update([
        'api_token' => MainHelper::createAPIToken(),
        'api_secret' => MainHelper::createAPISecret(),
      ]);
      return $this->response->noContent();
    }
    private function getCallData($user, $direction, $start, $end)
    {
      $calls = Call::where('created_at', '>=', $start)
                           ->where('created_at', '<=', $end)
                            ->where('user_id', '=', $user->id)
                            ->where('direction', '=', $direction);
      return $calls->count();
    }
    public function plans(Request $request)
    {

      $plans = Config::get("service_plans");
      return $this->response->array($plans);
    }
    public function upgradePlan(Request $request)
    {
      $json = $request->json()->all();
      $plans = Config::get("service_plans");
      $plan = $json['plan'];
      //$selected = $plans[$plan];
      $selected = ServicePlan::where('key_name', $plan)->first();
      $workspace = $this->getWorkspace($request);
      $user = $this->getUser($request);
      $period = PlanUsagePeriod::where('workspace_id', $workspace->id)->whereNull('ended_at')->first();
      $now = new DateTime();

      $period->update([
        'ended_at' => $now
      ]);
      $period = PlanUsagePeriod::create([
        'workspace_id' => $workspace->id,
        'started_at' => $now,
        'plan' => $plan
      ]);
      $workspace->update([
        'plan' => $selected['key_name']
      ]);
    $props = array(
      "billing_status" => "pending_processing",
      "new_plan" => $plan
    );
    WorkspaceEvent::addEvent($workspace, 'PLAN_UPGRADED', $props);
    // send an email including new plan details
      $data = [
        'user' => $user,
        'plan' => $plan
      ];
      $subject =MainHelper::createEmailSubject(sprintf("Upgraded plan to %s", $plan));
      $result = EmailHelper::sendEmail($subject, $user->email, 'plan_upgraded', $data);
      return $this->response->noContent();
    }

    public function dashboard(Request $request)
    {
      $dayCount = 7;
      $currentDay = 0;
      $labels = array();
      $data = array(
        "inbound" => array(),
        "outbound" => array()
      );
      $now = new DateTime();
      $start = clone $now;
      $start->sub(new DateInterval('P' . $dayCount . 'D'));
      $cloned1 = clone $start;
      $user = $this->getUser($request);
      $workspace = $this->getWorkspace($request);
      //$plans = \Config::get("service_plans");
      //$plan = $plans[ $workspace->plan ];
      $plan = ServicePlan::where('key_name', $workspace->plan)->firstOrFail()->toArray();
      while ($currentDay != $dayCount) {
        $labels[] = $cloned1->format("M-d");
        $cloned2 = clone $cloned1;
        $cloned2->add(new DateInterval('P1D'));
        $data['inbound'][] = $this->getCallData($user, 'inbound', $cloned1, $cloned2);
        //$data['inbound'][] = rand(1, 20);
        $data['outbound'][] = $this->getCallData($user, 'outbound', $cloned1, $cloned2);
        //$data['outbound'][] = rand(1,20);
        $cloned1->add(new DateInterval('P1D'));
        $currentDay = $currentDay + 1;
      }
      $graph = ['labels' => $labels, 'data' => $data];
      $user = $this->getUser($request);
        $billingInfo = BillingDataHelper::getBillingInfo($user, $plan);
       $billing = [
          'info' => $billingInfo
        ];

      $self = $this->getUser($request);
      $checklist = [
        'created_account' => FALSE,
        'filled_in_personal' => FALSE,
        'registered_did' => FALSE,
        'added_billing_info' => FALSE
      ];
      $checklist['created_account'] = TRUE;
      if (!empty($user->address_line_1) 
        && !empty($user->city) 
        && !empty($user->state) 
        && !empty($user->postal_code)
        && !empty($user->country)) {
          $checklist['filled_in_personal'] = TRUE;
        }
      $didCount = DIDNumber::where('user_id', $user->id)->count();
      if ($didCount > 0) {
        $checklist['registered_did'] = TRUE;
      }
      $cardCount = UserCard::where('user_id', '=', $user->id)->count();
      if ($cardCount > 0 || $user->linked_paypal) {
        $checklist['added_billing_info'] = TRUE;
      }


      return $this->response->array([
        $graph,
        $billing,
        $self->toArray(TRUE),
        $checklist,
        $plan,
        $workspace->toArrayWithRoles($user)
      ]);
    }
    public function fetchWorkspaceInfo(Request $request)
    {
      $hash = $request->get("hash");
      $workspaceUser = WorkspaceUser::where('hash', $hash)->firstOrFail();
      $workspace = Workspace::findOrFail($workspaceUser->workspace_id);
      $user = User::findOrFail($workspaceUser->user_id);
      $info = [
        'user' => $user,
        'workspace' => $workspace,
        'workspaceUser' => $workspaceUser
      ];
      return $this->response->array( $info );
    }
    public function billing(Request $request)
    {
        $user = $this->getUser($request);
        $billingInfo = BillingDataHelper::getBillingInfo($user);
       $billing = [
          'info' => $billingInfo
        ];
        $user = $this->getUser($request);
        $cards = UserCard::where('user_id', $user->id)->get()->toArray();
        $config = MainHelper::getPublicConfig();
        $billingHistory = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));

        foreach ($billingHistory as $key => $item) {
          $item->balance = MainHelper::toDollars($item->balance);
          $item->dollars = MainHelper::toDollars($item->cents);
          $billingHistory[ $key] = $item;
        }
        $triggers = UsageTrigger::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array([
            $billing,
            $cards,
            $config,
            $billingHistory,
            $triggers
         ]); 
    }
    public function getCountries() {
      return $this->response->array(MainHelper::getCountries());
    }
    public function getRegions(Request $request) {
      $country = $request->get("countryId");
      return $this->response->array(MainHelper::regionsList($country));
    }
    public function getRateCenters(Request $request) {
      $country = $request->get("countryId");
      $region = $request->get("regionId");
      return $this->response->array(MainHelper::rateCentersList($country, $region));
    }
    public function internalAppRedirect(Request $request) {
      $data = $request->json()->all();
      $token= $data['token'];
      $workspaceId = $data['workspaceId'];
      $user = JWTAuth::toUser($token);
      $workspace = Workspace::findOrFail($workspaceId);
          return $this->response->array([
            'token' => MainHelper::createJWTPayload($token),
            'workspace' => $workspace->toArrayWithRoles($user)
            //'expire_in' => \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'))->format('Y-m-d H:i:s')
        ]);
    }
  public function getPhoneSettingsByCat(Request $request) {
    $category = $request->get("categoryId");
    $phoneType = $request->get("phoneType");
    $settingId = $request->get("settingId");
    $phoneDefault = new PhoneDefault;
    $phoneSetting = PhoneGlobalSetting::where('public_id', $settingId)->firstOrFail();
    $settings = $phoneDefault->where('phone_type', $phoneType)->where('category_name', $category)->get()->toArray();
    $values = PhoneGlobalSettingValue::where('setting_id', $phoneSetting->id)->get()->toArray();
      return $this->response->array([
        'settings' => $settings,
        'values' => $values
      ]);
  }
  public function getDeployInfo(Request $request) {
    $workspace = $this->getWorkspace($request);
    $local_path = "/var/www/";
    //$remote_path = $workspace->provisionURL(); 
    $remote_path =MainHelper::createSubdomain("prv");
    $phones = Phone::where('workspace_id', $workspace->id)->where('needs_provisioning', '1')->count();
    return $this->response->array([
      'remote_path' => $remote_path,
      'devices_to_provision' => $phones
    ]);
  }
  public function startDeploy(Request $request) {
    $workspace = $this->getWorkspace($request);
    $phones = Phone::where('workspace_id', $workspace->id)->where('needs_provisioning', '1')->get();
    foreach ($phones as $phone) {
        PhoneProvisionHelper::provision($workspace, $phone);
    }
    return $this->response->noContent();
  }


  public function getPhoneIndividualSettingsByCat(Request $request) {
    $category = $request->get("categoryId");
    $phoneType = $request->get("phoneType");
    $settingId = $request->get("settingId");
    $phoneDefault = new PhoneDefault;
    //$phoneSetting = PhoneIndividualSetting::where('public_id', $settingId)->firstOrFail();
    $phoneSetting = PhoneIndividualSetting::select(DB::raw("phones_individual_settings.public_id, phones_individual_settings.id, phones_definitions.model, phones_definitions.manufacturer,phones_groups.name AS `group`, phones.phone_type"));
    $phoneSetting->leftJoin('phones', 'phones.id', '=', 'phones_individual_settings.phone_id');
    $phoneSetting->leftJoin('phones_definitions', 'phones_definitions.phone_type', '=', 'phones.phone_type');
    $phoneSetting->leftJoin('phones_groups', 'phones_groups.id', '=', 'phones.group_id');
    $phoneSetting = $phoneSetting->where('phones_individual_settings.public_id', $settingId)->firstOrFail();
    \Log::info(sprintf("looking up phone type %s, and category %s", $phoneSetting['phone_type'], $category));
    $settings = $phoneDefault->where('phone_type', $phoneSetting['phone_type']);
    $settings->where('category_name', $category);
    $settings = $settings->get()->toArray();
    $values = PhoneIndividualSettingValue::where('setting_id', $phoneSetting->id)->get()->toArray();
      return $this->response->array([
        'settings' => $settings,
        'values' => $values
      ]);
  }

  public function getPhoneDefaults(Request $request) {
    $phoneType = $request->get("phoneType");
    $groupId = $request->get("groupId");
    $phoneDefault = new PhoneDefault;
    if (!empty($phoneType)) {
       $phoneDefault = $phoneDefault->where('phone_type', $phoneType);
    }
   if (!empty($groupId)) {
$phoneDefault = $phoneDefault->where('phone_type', $phoneType);
    }
    $data = $phoneDefault->get()->toArray();
    $result = [
        'categories' => []
    ];
    foreach ($data as $key => $item) {
      $category = $item['category_name'];
      //if (!isset($result['categories'][$category])) {
      $newCategory = NULL;
      if (!$this->inCategories($result, $category)) {
        $newCategory = [
          'name' => $category,
          'slots' => []
        ];
      }
      if (!is_null($newCategory)) {
        $newCategory['slots'][] = $item;
        $result['categories'][] = $newCategory;
        continue;
      }
      $this->addToCategory($result, $item, $category);
    }
    //echo var_dump($result);
    return $this->response->array($result);
  }
   private function inCategories($result, $category) {
     foreach ($result['categories'] as $key => $item) {
        if ($item['name'] == $category) {
          return TRUE;
        }
      }
      return FALSE;
  }
   private function addToCategory(&$result, $item, $category) {
      foreach ($result['categories'] as $key => $array) {
        if ($result['categories'][$key]['name'] == $category) {
          $result['categories'][$key]['slots'][] = $item;
          return;
        }
      }
  }

   public function deleteAll(Request $request) {
      $data =$request->json()->all();
      $module = $data['module'];
      if ($module == 'numbers') { 
        foreach ( $data['items'] as $item) {
          $item = DIDNumber::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'faxes') { 
        foreach ( $data['items'] as $item) {
          $item = Fax::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'extensions') { 
        foreach ( $data['items'] as $item) {
          $item = Extension::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'files') { 
        foreach ( $data['items'] as $item) {
          $item = File::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'flows') { 
        foreach ( $data['items'] as $item) {
          $item = Flow::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'recordings') { 
        foreach ( $data['items'] as $item) {
          $item = Recording::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'phoneGroups') { 
        foreach ( $data['items'] as $item) {
          $item = PhoneGroup::findOrFail($item['id']);
          $item->delete();
        }
      }elseif ($module == 'phones') { 
        foreach ( $data['items'] as $item) {
          $item = Phone::findOrFail($item['id']);
          $item->delete();
        }
      }elseif ($module == 'blockedNumbers') { 
        foreach ( $data['items'] as $item) {
          $item = BlockedNumber::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'ips') { 
        foreach ( $data['items'] as $item) {
          $item = IpWhitelist::findOrFail($item['id']);
          $item->delete();
        }
      }elseif ($module == 'verifiedCalleIds') { 
        foreach ( $data['items'] as $item) {
          $item = VerifiedCallerId::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'workspaceUser') { 
        foreach ( $data['items'] as $item) {
          $item = WorkspaceUser::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'trunks') { 
        foreach ( $data['items'] as $item) {
          $item = SIPTrunk::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'carriers') { 
        foreach ( $data['items'] as $item) {
          $item = BYOCarrier::findOrFail($item['id']);
          $item->delete();
        }
      } elseif ($module == 'byo_numbers') { 
        foreach ( $data['items'] as $item) {
          $item = BYODIDNumber::findOrFail($itcm['id']);
          $item->delete();
        }
      }

  }
   public function submitJoinWorkspace(Request $request) {
      $data =$request->json()->all();
      $invite = WorkspaceInvite::where('hash', $data['hash'])->firstOrFail();
      $now = new DateTime();
      if (!$invite->valid) {
        return $this->response->errorInternal('Invite expired..');
      }
      if ($now->getTimestamp() > $invite->expires_on->getTimestamp()) {
        return $this->response->errorInternal('Invite expired..');
      }

      $workspaceUser = WorkspaceUser::where('hash', $data['hash'])->firstOrFail();
      $user = User::findOrFail($workspaceUser->user_id);
      $workspace = Workspace::findOrFail($workspaceUser->workspace_id);
      $user->update([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'password' => bcrypt($data['password']),
        'needs_password_set' => FALSE
      ]);
      $workspaceUser->update([
        'accepted' => TRUE,
        'hash_expired' => TRUE
      ]);
      $invite->update([
        'valid' => FALSE
      ]);

      try {
          // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::fromUser($user)) {
              return response()->json(['error' => 'could not create user'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return $this->errorInternal($request, 'Could not create token');
      }

      $result = MainHelper::createWorkspaceLoginResult($token, $user, $workspace);
      return $this->response->array( $result );
   }
  public function acceptWorkspaceInvite(Request $request) {
      $data =$request->json()->all();
      $workspaceUser = WorkspaceUser::where('hash', $data['hash'])->firstOrFail();
      $user = User::findOrFail($workspaceUser->user_id);
      $workspace = Workspace::findOrFail($workspaceUser->workspace_id);
      $workspaceUser->update([
        'accepted' => TRUE,
        'hash_expired' => TRUE
      ]);


      try {
          // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::fromUser($user)) {
              return response()->json(['error' => 'could not create user'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return $this->errorInternal($request, 'Could not create token');
      }

      $result = MainHelper::createWorkspaceLoginResult($token, $user, $workspace);
      return $this->response->array( $result );
    }
    public function updateWorkspace(Request $request) {
      $data =$request->json()->all();
      $workspace =$this->getWorkspace($request);
      $workspace->update($data);
      return $this->response->noContent();
    }
  public function getWorkspaceAPI(Request $request) {
      $data =$request->json()->all();
      $workspace =$this->getWorkspace($request);
      return $this->response->array(Workspace::findOrFail($workspace->id)->toArray());
    }

  public function upgradeMembership(Request $request) {
      $user = $this->getUser($request);
      $workspace =$this->getWorkspace($request);
      $data = $request->json()->all();
      $membership = $data['new_membership'];
      MainHelper::upgradeMembership($user, $workspace, $membership);
  }

  public function getConfig(Request $request) {
        $config = MainHelper::getPublicConfig();
        return $this->response->array($config);
  }

  public function getFlowPresets(Request $request) {
        $config = MainHelper::getPublicConfig();
        $templateId = $request->get("templateId");
        $workspace = $this->getWorkspace($request);
        $cursor = FlowTemplatePreset::where("template_id", $templateId);
        $count = $cursor->count();
        if ( $count > 0 ) {
          $options = $cursor->get()->toArray();
          $results = [];
          foreach ($options as $option) {
            $result = $option;
            if ($option['variable_type'] == 'basic') {
              if ( $option['data_type'] == 'select' ) {
                $result['options'] = json_decode($option['extras'], TRUE);
              }
            } elseif ( $option['variable_type'] == 'workspace_lookup') {
              if ( $option['data_type'] == 'select' ) {
                $table_results = \DB::table( $option['lookup_table'] )->where('workspace_id', $workspace->id)->get();
                $opts = [];
                foreach ($table_results as $table_result) {
                  $opts[] = $table_result->{$option['lookup_key']};
                }
                $result['options'] = $opts;
              }
            }
            $results[] = $result;
          }
          $result = ['has_presets' => TRUE, 'presets' => $results];
          return $this->response->array($result);
        }
        $result = ['has_presets' => FALSE];
        return $this->response->array($result);
  }
  public function saveUpdatedPresets(Request $request) {
                $config = MainHelper::getPublicConfig();
        $templateId = $request->get("templateId");
        $flowId = $request->get("flowId");
        $values = $request->json()->all();
        $flow = Flow::where('public_id', $flowId)->firstOrFail();
        $json = json_decode($flow->flow_json, TRUE);
        $updated_models = [];
        foreach ($json['models'] as $model) {
          $copy = $model;
          $params = $model['data'];
          foreach ( $values as $value ) {
              if ( $model['name'] == $value['widget'] ) {
                  $params[$value['widget_key']] = $value['value'];
              }
        }
        $copy['data'] = $params;
        $updated_models[] = $copy;
      }
        \Log::info(json_encode($updated_models));

      $json['models'] = $updated_models;
      $flow->update([
        'flow_json' => json_encode( $json )
      ]);
      return $this->response->noContent();


  }

  public function getPOPs(Request $request) {
        $config = \Config::get("mothernodes");
        $options = MainHelper::getRegions();
        return $this->response->array($options);
      }

  public function getRegistrationQuestions(Request $request) {
    $response = [];
    $questions = RegistrationQuestionnaire::get();
    /*
    TODO: implement code for multiple choice responses
    foreach ( $questions as $item ) {
      $item['responses'] = RegistrationResponse::where('response_id', $item->id)->get()->toArray();
      $response[] = $item;
    }
    */
    return $this->response->array($response);
  }
  public function getAllSettings(Request $request) {
        $apiCreds = APICredential::getFrontendValuesOnly();
        $customizations = Customizations::getRecord();
        $availableThemes = array(
          array(
            'name' => 'default',
            'is_default' => TRUE
          ),
          array(
            'name' => 'dark',
            'is_default' => FALSE
          )
        );
        $result = [
          'customizations' => $customizations->toArray(),
          'frontend_api_creds' => $apiCreds,
          'available_themes' => $availableThemes
        ];
        return $this->response->array($result);
      }

  public function getServicePlans(Request $request) {
      $plans = ServicePlan::all()->toArray();
      $features = [
        'fax',
        'im_integrations',
        'productivity_integrations',
        'voice_analytics',
        'fraud_protection',
        'crm_integrations',
        'programmable_toolkit',
        'sso',
        'provisioner',
        'vpn',
        'multiple_sip_domains',
        'bring_carrier',
        'featured_plan',
        'pay_as_you_go',
        'registration_plan',
      ];
      $results = [];
      foreach ( $plans as $cnt => $plan ) {
        $plan_features = [];
        foreach ($features as $feature) {
          $plan_features[] = [
            'key' => $feature,
            'value' =>$plan[$feature],
            'description' => ServicePlan::getFeatureDescription( $feature )
          ];
        }
        $item = $plan;
        $item['monthly_charge'] = MainHelper::toDollars($item['monthly_charge_cents']);
        $plan_benefits = [];
        // compare the previous plan with the current one to get the benefits
        $last_cnt = $cnt - 1;
        if ( array_key_exists( $last_cnt, $plans) ) {
          $last_plan = $plans[$last_cnt];
          foreach ($features as $feature) {
            $has_feature_1 = $plan[$feature];
            $has_feature_2 = $last_plan[$feature];
            if ( !$has_feature_2 && $has_feature_1 ) {
              $plan_benefits[] = [
                'key' => $feature,
                'value' => TRUE,
                'description' => ServicePlan::getFeatureDescription( $feature )
              ];
            }
          }
        } else {
          $plan_benefits = $plan_features;
        }
        $item['features'] = $plan_features;
        $item['benefits'] = $plan_benefits;
        $results[] = $item;
      }
        return $this->response->array($results);
      }

  public function search(Request $request) {
      $query = $request->get("query");
      $result = PortalSearchHelper::search( $query );
      return $this->response->array($result);
  }

  public function billingDiscontinue(Request $request) {
    // downgrade plan to pay as you go
    $workspace = $this->getWorkspace($request);
    $servicePlan = ServicePlan::getPayAsYouGoplan();
    $workspace->update([
      'plan' => $servicePlan->key_name
    ]);
    $props = array(
      "billing_status" => "pending_processing"
    );
    WorkspaceEvent::addEvent($workspace, 'PLAN_CANCELLED', $props);
  }

  public function save2FASettings(Request $request) {
    $user = $this->getUser($request);
    $data = $request->json()->all();
    $updateParams = [];

    if (!empty($data['enable_2fa'])) {
      $updateParams['enable_2fa'] = $data['enable_2fa'];
    }
    if (!empty($data['type_of_2fa'])) {
      $updateParams['type_of_2fa'] = $data['type_of_2fa'];
    }
    $type2fa = $data['type_of_2fa'];
    if ( $updateParams['enable_2fa'] ) {
      // ensure that the code is correct
      if ( $type2fa == 'totp') {
        $user->update($updateParams);
        return $this->response->noContent();
      }
      if (!empty( $data['confirmation_code'] ) ) {
        $confirmationCode = $data['confirmation_code'];
        $otp = TOTP::create($user->secret_code_2fa);
        if ( $otp->verify($confirmationCode)) {
          return $this->response->errorBadRequest();
        }
        $user->update($updateParams);
        return $this->response->noContent();
      }
      $user->update($updateParams);
      return $this->response->noContent();
    }
    $user->update($updateParams);
    return $this->response->noContent();
  }

  public function get2FAConfig(Request $request) {
    $user = $this->getUser($request);
    $secret = $user->secret_code_2fa;
    if ( empty( $secret )) {
      $otp = TOTP::create();
      $secret = $otp->getSecret();
      $user->update(['secret_code_2fa' => $secret]);
    }
    $otp = TOTP::create($secret);
    //render the QR code
    $renderer = new ImageRenderer(
        new RendererStyle(400),
        new ImagickImageBackEnd()
    );
    $writer = new QRWriter($renderer);
    $domain = MainHelper::getDeploymentDomain();
    //$tag = "access";
    $tag = $user->email;
    $otpData = sprintf("otpauth://totp/%s?secret=%s&issuer=%s", $tag, $secret, $domain);
    //$qrCode = new QRCode();
    //$qrContents = $qrCode->render( $otpData );
    $qrContents = base64_encode( $writer->writeString($otpData) );

    return $this->response->array([
      'secret_code' => $secret,
      'qrcode_base64' => $qrContents
    ]);
  }
  public function request2FAConfirmationCode(Request $request) {
    $type_of_2fa = $request->get('type_of_2fa');
    $user = $this->getUser($request);
    if ( $type_of_2fa == 'sms') {
      $from = '';
      $to = $user->phone_number;
      $otp = TOTP::create($user->secret_code_2fa);
      $body = sprintf("Your confirmation code for 2FA is: %s", $otp);
      SMSHelper::sendSMS($from, $to, $body);
      return $this->response->array([
          'success' => true
      ]);
    } else if ( $type_of_2fa == 'whatsapp') {
      $from = '';
      $to = $user->phone_number;
      $otp = TOTP::create($user->secret_code_2fa);
      $body = sprintf("Your confirmation code for 2FA is: %s", $otp);
      MainHelper::sendWhatsAppMessage($to, $body);
      return $this->response->array([
          'success' => true
      ]);
    }
    return $this->response->array([
        'success' => true
    ]);
  }
  public function request2FACode(Request $request) {
    $email = $request->get('email');
    $password = $request->get('password');
    $credentials = ['email'=>$email, 'password' => $password];
    $valid = Auth::attempt($credentials);
    if ( !$valid ) {
      return $this->response->errorForbidden();
    }
    $user = Auth::getUser();
    $data = $request->json()->all();

    if ( !$user->enable_2fa ) {
      return $this->response->errorForbidden();
    }
    if ( $user->type_of_2fa == 'totp') {
      $otp = TOTP::create($user->secret_code_2fa);
      return $this->response->array([
          'success' => true
      ]);
    } elseif ( $user->type_of_2fa == 'sms') {
      $from = '';
      $to = $user->phone_number;
      $otp = TOTP::create($user->secret_code_2fa);
      $body = sprintf("Your OTP is %s", $otp->now());
      SMSHelper::sendSMS($from, $to, $body);
      return $this->response->array([
          'success' => true
      ]);
    } elseif ( $user->type_of_2fa == 'whatsapp') {
      $to = $user->phone_number;
      $otp = TOTP::create($user->secret_code_2fa);
      $body = sprintf("Your OTP is %s", $otp->now());
      MainHelper::sendWhatsAppMessage($to, $body);
      return $this->response->array([
          'success' => true
      ]);
    }
    return $this->response->errorForbidden();
  }

  public function verify2FACode(Request $request) {
    $data = $request->json()->all();
    $credentials = ['email'=>$data['email'], 'password' => $data['password']];

    $valid =Auth::attempt($credentials);
    if ( !$valid ) {
      return $this->response->errorForbidden();
    }

    $user = Auth::getUser();

    if ( !$user->enable_2fa ) {
      return $this->response->errorForbidden();
    }
    $data = $request->json()->all();
    $input = $data['2fa_code'];
    $otp = TOTP::create($user->secret_code_2fa);
    if ( $otp->verify($input) ) {
      $token = JWTAuth::attempt($credentials);
      $workspace = $user->getDefaultWorkspace();
      $loginData = MainHelper::createWorkspaceLoginResult($token, $user, $workspace);
      $result =array_merge([
        'success' => true
      ], $loginData);
      return $this->response->array($result);
    }
    return $this->response->array([
      'success' => FALSE
    ]);
  }

  public function getCountryList() {
    // TODO: create database tables for countries data
    $path = public_path('assets/misc/countries.json');
    $countries = json_decode( file_get_contents( $path ), TRUE );
    return $this->response->array([
      'data' => $countries
    ]);
  }
  public function getBillingCountries() {
    $regions = BillingRegion::select(array(
      DB::raw('billing_regions.name AS region_name'),
      DB::raw('billing_regions.id AS region_id'),
      DB::raw('billing_countries.name AS country_name'),
      DB::raw('billing_countries.id AS country_id'),
      DB::raw('billing_countries.iso AS iso'),
    ));
    $regions->join('billing_countries', 'billing_countries.id', '=', 'billing_regions.billing_country_id');
    $regions = $regions->get();
    $results = [];
    foreach ( $regions as $item ) {
      $matches = array_filter( $results, function($match) use ($item) {
          if ( $item['iso'] == $match['iso'] ) {
            return TRUE;
          }
          return FALSE;
      });
      $countryBillingData = new \ArrayObject();
      $countryBillingData->offsetSet('iso', $item['iso']);
      $countryBillingData->offsetSet('name', $item['country_name']);
      $countryBillingData->offsetSet('country_id', $item['country_id']);
      $countryBillingData->offsetSet('states', []);
      if (!empty( $matches ) && count( $matches ) > 0 ) {
        $keys = array_keys( $matches );
        $countryBillingData = $matches[$keys[0]];
      }
      $states = $countryBillingData->offsetGet('states');
      $states[] = [
        'name' => $item['region_name'],
        'id' => $item['region_id'],
      ];
      $countryBillingData->offsetSet('states', $states);
      if (!in_array($countryBillingData, $results)) {
        $results[] = $countryBillingData;
      }
    }
    foreach ( $results as $key => $item ) {
      $results[$key] = $item->getArrayCopy();
    }
    
      return $this->response->array($results);
  }

  private function needsCustomPaymentForm() {
    return FALSE;
  }

  public function saveCustomerPaymentDetails(Request $request) 
  {
    $data = $request->json()->all();
    $userId = $data['user_id'];
    $workspaceId = $data['workspace_id'];
    //$user = $this->getUser( $request );
    $user = User::findOrFail($userId);
    //$workspace = $this->getWorkspace( $request );
    //$workspace = Workspace::where('creator_id', '=', $user->id)->firstOrFail();
    $workspace = Workspace::findOrFail($workspaceId);

    // set the billing region
    $region = $data['billing_region_id'];
    $gateway = $data['payment_gateway'];
    $paymentCard = $data['payment_card'];
    $paymentValues = $data['payment_values'];

    if (!$this->needsCustomPaymentForm()) {
      $cardData = [
        'payment_method_id' => $paymentValues['payment_method_id'],
        'issuer' => $paymentValues['issuer'],
        'last_4' => $paymentValues['last_4'],
      ];
    } else {
      // get card data
      $cardData = [
        'payment_card_number' => $cardData['payment_card_number'],
        'expiration_date' => $cardData['expiration_date'],
        'security_code' => $cardData['security_code'],
        'cardholder_name' => $cardData['cardholder_name']
      ];
    }
    $result = BillingDataHelper::updateWorkspaceBilling($gateway, $cardData, $user, $workspace);
    if (!$result) {
      return $this->response->errorBadRequest();
    }

    $workspace->update([
      'billing_region_id' => $region
    ]);
    return $this->response->noContent();
  }

}