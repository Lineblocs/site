<?php

namespace App\Http\Controllers\Api\PhoneGlobalSetting;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\PhoneGlobalSetting;
use \App\PhoneGlobalSettingValue;
use \App\PhoneGlobalDefinition;
use \App\Transformers\PhoneGlobalSettingTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Phone;



class PhoneGlobalSettingController extends ApiAuthController {
    public function phoneGlobalData(Request $request, $phoneSettingId)
    {
        $phoneSettings = PhoneGlobalSetting::where('public_id', '=', $phoneSettingId)->firstOrFail();
        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneglobalsettings')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($phoneSettings->toArray());
    }
    public function listPhoneGlobalSettings(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
      $workspace = $workspace = $this->getWorkspace($request); 
        $phoneSettings = PhoneGlobalSetting::where('workspace_id', $workspace->id);
        $phoneSettings = PhoneGlobalSetting::select(DB::raw("phones_global_settings.*,phones_definitions.model, phones_definitions.manufacturer,phones_groups.name AS `group`"));
        $phoneSettings->leftJoin('phones_definitions', 'phones_definitions.phone_type', '=', 'phones_global_settings.phone_type');
        $phoneSettings->leftJoin('phones_groups', 'phones_groups.id', '=', 'phones_global_settings.phone_group');

        MainHelper::addSearch($request, $phoneSettings, ['name']);
        return $this->response->paginator($phoneSettings->paginate($paginate), new PhoneGlobalSettingTransformer);
    }

    public function deletePhoneGlobalSetting(Request $request, $phoneSettingId)
    {
        $phoneSettings = PhoneGlobalSetting::findOrFail($phoneSettingId);
        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneglobalsettings')) {
            return $this->response->errorForbidden();
        }
        $phoneSettings->delete();
   }
    public function updatePhoneGlobalSetting(Request $request, $phoneSettingId)
    {
        $phoneSettings = PhoneGlobalSetting::where('public_id', $phoneSettingId)->firstOrFail();
        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneglobalsettings')) {
            return $this->response->errorForbidden();
        }
        $data = $request->json()->all();
        $current = PhoneGlobalSettingValue::where('setting_id', $phoneSettings->id)->get();
        foreach ($data as $key => $value) {
            $exists = FALSE;
            foreach ($current as $check) {
                if ($check['setting_variable_name'] == $key) {
                    $exists = TRUE;
                    $check->update([
                        'setting_option_1' => $value
                    ]);
                    break;
                }
            }
            if (!$exists) {
                PhoneGlobalSettingValue::create([
                    'setting_variable_name' => $key,
                    'setting_option_1' => $value,
                    'setting_id' => $phoneSettings->id
                ]);
            }
        }
        $workspace = $this->getWorkspace($request);
        $query = Phone::where('workspace_id', $workspace->id)
            ->where('phone_type', $phoneSettings->phone_type);
        if (!empty($phoneSettings->phone_group)) {
            $query->where('group_id', $phoneSettings->phone_group);
        }
        $results = $query->get();
        foreach ($results as $item) {
            $item->update([
                'needs_provisioning' => TRUE
            ]);
        }

        return $this->response->noContent();
   }
    public function savePhoneGlobalSetting(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_phoneglobalsetting')) {
          return $this->errorPerformingAction();
        }
        $settings = PhoneGlobalSetting::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'phone_type' => $data['phone_type'],
            'phone_group' => $data['phone_group']
        ]);
      return $this->response->noContent()->withHeader('X-GlobalSetting-ID', $settings->public_id);
   }
}




