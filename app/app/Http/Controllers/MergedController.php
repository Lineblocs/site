<?php
namespace App\Http\Controllers;

use App\BlockedNumber;
use App\Call;
use App\CallSystemTemplate;
use App\Customizations;
use App\DIDNumber;
use App\Extension;
use App\Fax;
use App\File;
use App\Flow;
use App\FlowTemplatePreset;
use App\Helpers\MainHelper;
use App\Helpers\PhoneProvisionHelper;
use App\Http\Controllers\Api\ApiAuthController;
use App\IpWhitelist;
use App\Phone;
use App\PhoneDefault;
use App\PhoneGlobalSetting;
use App\PhoneGlobalSettingValue;
use App\PhoneGroup;
use App\PhoneIndividualSetting;
use App\PhoneIndividualSettingValue;
use App\PlanUsagePeriod;
use App\Recording;
use App\SIPTrunk;
use App\UsageTrigger;
use App\User;
use App\UserCard;
use App\VerifiedCallerId;
use App\Workspace;
use App\WorkspaceInvite;
use App\WorkspaceUser;
use DateInterval;
use DateTime;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use \Config;

class MergedController extends ApiAuthController
{

    public function verifyPasswordStrength(Request $request)
    {
        $password = $request->json()->all()['password'];
        if (strlen($password) < 8) {
            return $this->response->array([
                'success' => false,
                'validationError' => 'Length must be 8 or more characters',
            ]);
        } elseif (!preg_match("#[0-9]+#", $password)) {
            return $this->response->array([
                'success' => false,
                'validationError' => 'Must contain 1 number',
            ]);

        } elseif (!preg_match("#[A-Z]+#", $password)) {
            return $this->response->array([
                'success' => false,
                'validationError' => 'Must contain 1 capital letter',
            ]);

        } elseif (!preg_match("#[a-z]+#", $password)) {
            return $this->response->array([
                'success' => false,
                'validationError' => 'Must contain 1 lowercase letter',
            ]);

        } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            return $this->response->array([
                'success' => false,
                'validationError' => 'Must contain 1 special character',
            ]);

        }
        return $this->response->array([
            'success' => true,
        ]);

    }
    public function generateSecurePassword(Request $request)
    {
        $password = MainHelper::randomPassword();
        return $this->response->array([
            'password' => $password,
        ]);

    }
    public function getBillingHistory(Request $request)
    {
        $user = $this->getUser($request);
        $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));
        $data = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));
        return $this->response->array($data);

    }
    public function changeBillingSettings(Request $request)
    {
        $user = $this->getUser($request);
        $update = $request->only(['auto_recharge', 'auto_recharge_top_up']);
        $user->update($update);
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
            'api_secret' => $workspace->api_secret,
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
        $selected = $plans[$plan];
        $workspace = $this->getWorkspace($request);
        $user = $this->getUser($request);
        $period = PlanUsagePeriod::where('workspace_id', $workspace->id)->where('active', '1')->firstOrFail();
        $now = new DateTime();

        $period->update([
            'ended_at' => $now,
        ]);
        $period = PlanUsagePeriod::create([
            'workspace_id' => $workspace->id,
            'started_at' => $now,
            'plan' => $plan,
        ]);
        $workspace->update([
            'plan' => $selected['key_name'],
        ]);
        return $this->response->noContent();
    }

    public function dashboard(Request $request)
    {
        $dayCount = 7;
        $currentDay = 0;
        $labels = array();
        $data = array(
            "inbound" => array(),
            "outbound" => array(),
        );
        $now = new DateTime();
        $start = clone $now;
        $start->sub(new DateInterval('P' . $dayCount . 'D'));
        $cloned1 = clone $start;
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $plans = \Config::get("service_plans");
        $plan = $plans[$workspace->plan];
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
            'info' => $billingInfo,
        ];

        $self = $this->getUser($request);
        $checklist = [
            'created_account' => false,
            'filled_in_personal' => false,
            'registered_did' => false,
            'added_billing_info' => false,
        ];
        $checklist['created_account'] = true;
        if (!empty($user->address_line_1)
            && !empty($user->city)
            && !empty($user->state)
            && !empty($user->postal_code)
            && !empty($user->country)) {
            $checklist['filled_in_personal'] = true;
        }
        $didCount = DIDNumber::where('user_id', $user->id)->count();
        if ($didCount > 0) {
            $checklist['registered_did'] = true;
        }
        $cardCount = UserCard::where('user_id', '=', $user->id)->count();
        if ($cardCount > 0 || $user->linked_paypal) {
            $checklist['added_billing_info'] = true;
        }

        return $this->response->array([
            $graph,
            $billing,
            $self->toArray(true),
            $checklist,
            $plan,
            $workspace->toArrayWithRoles($user),
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
            'workspaceUser' => $workspaceUser,
        ];
        return $this->response->array($info);
    }
    public function billing(Request $request)
    {
        $user = $this->getUser($request);
        $billingInfo = $user->getBillingInfo();
        $billing = [
            'info' => $billingInfo,
        ];
        $user = $this->getUser($request);
        $cards = UserCard::where('user_id', $user->id)->get()->toArray();
        $config = MainHelper::getPublicConfig();
        $billingHistory = DB::select(sprintf('select * from (select balance, status, cents, created_at, \'credit\' as type, user_id from users_credits  union  select balance, status, cents, created_at, \'invoice\' as type, user_id from users_invoices order by created_at desc) as U where U.user_id = "%s";', $user->id));

        foreach ($billingHistory as $key => $item) {
            $item->balance = MainHelper::toDollars($item->balance);
            $item->dollars = MainHelper::toDollars($item->cents);
            $billingHistory[$key] = $item;
        }
        $triggers = UsageTrigger::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array([
            $billing,
            $cards,
            $config,
            $billingHistory,
            $triggers,
        ]);
    }
    public function getCountries()
    {
        return $this->response->array(MainHelper::getCountries());
    }
    public function getRegions(Request $request)
    {
        $country = $request->get("countryId");
        return $this->response->array(MainHelper::regionsList($country));
    }
    public function getRateCenters(Request $request)
    {
        $country = $request->get("countryId");
        $region = $request->get("regionId");
        return $this->response->array(MainHelper::rateCentersList($country, $region));
    }
    public function internalAppRedirect(Request $request)
    {
        $data = $request->json()->all();
        $token = $data['token'];
        $workspaceId = $data['workspaceId'];
        $user = JWTAuth::toUser($token);
        $workspace = Workspace::findOrFail($workspaceId);
        return $this->response->array([
            'token' => MainHelper::createJWTPayload($token),
            'workspace' => $workspace->toArrayWithRoles($user),
            //'expire_in' => \Carbon\Carbon::now()->addMinutes(config('jwt.ttl'))->format('Y-m-d H:i:s')
        ]);
    }
    public function getPhoneSettingsByCat(Request $request)
    {
        $category = $request->get("categoryId");
        $phoneType = $request->get("phoneType");
        $settingId = $request->get("settingId");
        $phoneDefault = new PhoneDefault;
        $phoneSetting = PhoneGlobalSetting::where('public_id', $settingId)->firstOrFail();
        $settings = $phoneDefault->where('phone_type', $phoneType)->where('category_name', $category)->get()->toArray();
        $values = PhoneGlobalSettingValue::where('setting_id', $phoneSetting->id)->get()->toArray();
        return $this->response->array([
            'settings' => $settings,
            'values' => $values,
        ]);
    }
    public function getDeployInfo(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $local_path = "/var/www/";
        //$remote_path = $workspace->provisionURL();
        $remote_path = "prv.lineblocs.com";
        $phones = Phone::where('workspace_id', $workspace->id)->where('needs_provisioning', '1')->count();
        return $this->response->array([
            'remote_path' => $remote_path,
            'devices_to_provision' => $phones,
        ]);
    }
    public function startDeploy(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $phones = Phone::where('workspace_id', $workspace->id)->where('needs_provisioning', '1')->get();
        foreach ($phones as $phone) {
            PhoneProvisionHelper::provision($workspace, $phone);
        }
        return $this->response->noContent();
    }

    public function getPhoneIndividualSettingsByCat(Request $request)
    {
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
            'values' => $values,
        ]);
    }

    public function getPhoneDefaults(Request $request)
    {
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
            'categories' => [],
        ];
        foreach ($data as $key => $item) {
            $category = $item['category_name'];
            //if (!isset($result['categories'][$category])) {
            $newCategory = null;
            if (!$this->inCategories($result, $category)) {
                $newCategory = [
                    'name' => $category,
                    'slots' => [],
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
    private function inCategories($result, $category)
    {
        foreach ($result['categories'] as $key => $item) {
            if ($item['name'] == $category) {
                return true;
            }
        }
        return false;
    }
    private function addToCategory(&$result, $item, $category)
    {
        foreach ($result['categories'] as $key => $array) {
            if ($result['categories'][$key]['name'] == $category) {
                $result['categories'][$key]['slots'][] = $item;
                return;
            }
        }
    }

    public function deleteAll(Request $request)
    {
        $data = $request->json()->all();
        $module = $data['module'];
        if ($module == 'numbers') {
            foreach ($data['items'] as $item) {
                $item = DIDNumber::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'faxes') {
            foreach ($data['items'] as $item) {
                $item = Fax::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'extensions') {
            foreach ($data['items'] as $item) {
                $item = Extension::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'files') {
            foreach ($data['items'] as $item) {
                $item = File::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'flows') {
            foreach ($data['items'] as $item) {
                $item = Flow::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'recordings') {
            foreach ($data['items'] as $item) {
                $item = Recording::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'phoneGroups') {
            foreach ($data['items'] as $item) {
                $item = PhoneGroup::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'phones') {
            foreach ($data['items'] as $item) {
                $item = Phone::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'blockedNumbers') {
            foreach ($data['items'] as $item) {
                $item = BlockedNumber::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'ips') {
            foreach ($data['items'] as $item) {
                $item = IpWhitelist::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'verifiedCalleIds') {
            foreach ($data['items'] as $item) {
                $item = VerifiedCallerId::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'workspaceUser') {
            foreach ($data['items'] as $item) {
                $item = WorkspaceUser::findOrFail($item['id']);
                $item->delete();
            }
        } elseif ($module == 'trunks') {
            foreach ($data['items'] as $item) {
                $item = SIPTrunk::findOrFail($item['id']);
                $item->delete();
            }
        }

    }
    public function submitJoinWorkspace(Request $request)
    {
        $data = $request->json()->all();
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
            'needs_password_set' => false,
        ]);
        $workspaceUser->update([
            'accepted' => true,
            'hash_expired' => true,
        ]);
        $invite->update([
            'valid' => false,
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
        return $this->response->array($result);
    }
    public function acceptWorkspaceInvite(Request $request)
    {
        $data = $request->json()->all();
        $workspaceUser = WorkspaceUser::where('hash', $data['hash'])->firstOrFail();
        $user = User::findOrFail($workspaceUser->user_id);
        $workspace = Workspace::findOrFail($workspaceUser->workspace_id);
        $workspaceUser->update([
            'accepted' => true,
            'hash_expired' => true,
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
        return $this->response->array($result);
    }
    public function updateWorkspace2(Request $request)
    {
        $data = $request->json()->all();
        $workspace = $this->getWorkspace($request);
        $workspace->update($data);
        return $this->response->noContent();
    }
    public function getWorkspaceAPI(Request $request)
    {
        $data = $request->json()->all();
        $workspace = $this->getWorkspace($request);
        return $this->response->array(Workspace::findOrFail($workspace->id)->toArray());
    }

    public function upgradeMembership(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $data = $request->json()->all();
        $membership = $data['new_membership'];
        MainHelper::upgradeMembership($user, $workspace, $membership);
    }

    public function getConfig(Request $request)
    {
        $config = MainHelper::getPublicConfig();
        return $this->response->array($config);
    }

    public function getFlowPresets(Request $request)
    {
        $config = MainHelper::getPublicConfig();
        $templateId = $request->get("templateId");
        $workspace = $this->getWorkspace($request);
        $cursor = FlowTemplatePreset::where("template_id", $templateId);
        $count = $cursor->count();
        if ($count > 0) {
            $options = $cursor->get()->toArray();
            $results = [];
            foreach ($options as $option) {
                $result = $option;
                if ($option['variable_type'] == 'basic') {
                    if ($option['data_type'] == 'select') {
                        $result['options'] = json_decode($option['extras'], true);
                    }
                } elseif ($option['variable_type'] == 'workspace_lookup') {
                    if ($option['data_type'] == 'select') {
                        $table_results = \DB::table($option['lookup_table'])->where('workspace_id', $workspace->id)->get();
                        $opts = [];
                        foreach ($table_results as $table_result) {
                            $opts[] = $table_result->{$option['lookup_key']};
                        }
                        $result['options'] = $opts;
                    }
                }
                $results[] = $result;
            }
            $result = ['has_presets' => true, 'presets' => $results];
            return $this->response->array($result);
        }
        $result = ['has_presets' => false];
        return $this->response->array($result);
    }
    public function saveUpdatedPresets(Request $request)
    {
        $config = MainHelper::getPublicConfig();
        $templateId = $request->get("templateId");
        $flowId = $request->get("flowId");
        $values = $request->json()->all();
        $flow = Flow::where('public_id', $flowId)->firstOrFail();
        $json = json_decode($flow->flow_json, true);
        $updated_models = [];
        foreach ($json['models'] as $model) {
            $copy = $model;
            $params = $model['data'];
            foreach ($values as $value) {
                if ($model['name'] == $value['widget']) {
                    $params[$value['widget_key']] = $value['value'];
                }
            }
            $copy['data'] = $params;
            $updated_models[] = $copy;
        }
        \Log::info(json_encode($updated_models));

        $json['models'] = $updated_models;
        $flow->update([
            'flow_json' => json_encode($json),
        ]);
        return $this->response->noContent();

    }

    public function getPOPs(Request $request)
    {
        $config = \Config::get("mothernodes");
        $options = MainHelper::getRegions();
        return $this->response->array($options);
    }
    public function getAllSettings(Request $request)
    {

        $customizations = Customizations::getRecord();
        $result = [
            'customizations' => $customizations->toArray(),
        ];
        return $this->response->array($result);
    }

}
