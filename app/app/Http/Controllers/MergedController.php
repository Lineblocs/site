<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Call;
use App\UserCard;
use App\UsageTrigger;
use App\DIDNumber;
use App\CallSystemTemplate;
use App\Workspace;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\PhoneDefault;
use App\Fax;

use App\Extension;
use App\File;
use App\Flow;
use App\Recording;
use App\IpWhitelist;
use App\BlockedNumber;
use App\VerifiedCallerId;
use App\Phone;
use App\PhoneGroup;
use App\WorkspaceUser;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Helpers\PBXServerHelper;
use App\Helpers\MainHelper;
use App\Helpers\AWSHelper;
use App\Helpers\NamecheapHelper;
use App\Helpers\PhoneProvisionHelper;

use App\PhoneGlobalSetting;
use App\PhoneGlobalSettingValue;
use App\PhoneIndividualSetting;
use App\PhoneIndividualSettingValue;

use \Config;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
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
        $billingInfo = $user->getBillingInfo();
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
        $checklist
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
        $billingInfo = $user->getBillingInfo();
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
    $remote_path = "prv.lineblocs.com";
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
      }

  }
   public function submitJoinWorkspace(Request $request) {
      $data =$request->json()->all();
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
    public function updateWorkspace2(Request $request) {
      $data =$request->json()->all();
      $workspace =$this->getWorkspace($request);
      $workspace->update($data);
      return $this->response->noContent();
    }
  public function getWorkspace(Request $request) {
      $data =$request->json()->all();
      $workspace =$this->getWorkspace($request);
      return $this->response->array(Workspace::findOrFail($workspace->id)->toArray());
    }






}
