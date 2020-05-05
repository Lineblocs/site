<?php

namespace App\Http\Controllers\Api\PhoneIndividualSetting;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\PhoneIndividualSetting;
use \App\PhoneIndividualSettingValue;
use \App\PhoneIndividualDefinition;
use \App\Transformers\PhoneIndividualSettingTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Phone;



class PhoneIndividualSettingController extends ApiAuthController {
    public function phoneIndividualData(Request $request, $phoneSettingId)
    {
        $phoneSettings = PhoneIndividualSetting::select(DB::raw("phones_individual_settings.*, phones_definitions.phone_type"));
        $phoneSettings->leftJoin('phones', 'phones.id', '=', 'phones_individual_settings.phone_id');
        $phoneSettings->leftJoin('phones_definitions', 'phones_definitions.phone_type', '=', 'phones.phone_type');
        $phoneSettings->where('phones_individual_settings.public_id', $phoneSettingId);
        $phoneSettings = $phoneSettings->firstOrFail();


        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneindividualsettings')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($phoneSettings->toArray());
    }
    public function listPhoneIndividualSettings(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
      $workspace = $workspace = $this->getWorkspace($request); 
        $phoneSettings = PhoneIndividualSetting::select(DB::raw("phones_individual_settings.public_id, phones_definitions.model, phones_definitions.manufacturer,phones_groups.name AS `group`, phones.name"));
        $phoneSettings->leftJoin('phones', 'phones.id', '=', 'phones_individual_settings.phone_id');
        $phoneSettings->leftJoin('phones_definitions', 'phones_definitions.phone_type', '=', 'phones.phone_type');
        $phoneSettings->leftJoin('phones_groups', 'phones_groups.id', '=', 'phones.group_id');

        MainHelper::addSearch($request, $phoneSettings, ['name']);
        return $this->response->paginator($phoneSettings->paginate($paginate), new PhoneIndividualSettingTransformer);
    }

    public function deletePhoneIndividualSetting(Request $request, $phoneSettingId)
    {
        $phoneSettings = PhoneIndividualSetting::findOrFail($phoneSettingId);
        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneindividualsettings')) {
            return $this->response->errorForbidden();
        }
        $phoneSettings->delete();
   }
    public function updatePhoneIndividualSetting(Request $request, $phoneSettingId)
    {
       $phoneSettings = PhoneIndividualSetting::where('public_id', $phoneSettingId)->firstOrFail();
        if (!$this->hasPermissions($request, $phoneSettings, 'manage_phoneindividualsettings')) {
            return $this->response->errorForbidden();
        }
        $data = $request->json()->all();
        $current = PhoneIndividualSettingValue::where('setting_id', $phoneSettings->id)->get();
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
                PhoneIndividualSettingValue::create([
                    'setting_variable_name' => $key,
                    'setting_option_1' => $value,
                    'setting_id' => $phoneSettings->id
                ]);
            }
        }
        $workspace = $this->getWorkspace($request);
        $item= Phone::findOrFail($phoneSettings->phone_id);
        $item->update([
            'needs_provisioning' => TRUE
        ]);

        return $this->response->noContent();

   }
}




