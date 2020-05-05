<?php

namespace App\Http\Controllers\Api\Phone;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Phone;
use \App\PhoneTag;
use \App\PhoneDefinition;
use \App\PhoneIndividualSetting;
use \App\Transformers\PhoneTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use Mail;
use Config;



class PhoneController extends ApiAuthController {
    public function phoneData(Request $request, $phoneId)
    {
        $phone = Phone::where('public_id', '=', $phoneId)->firstOrFail();
        if (!$this->hasPermissions($request, $phone, 'manage_phones')) {
            return $this->response->errorForbidden();
        }
        $array = $phone->toArray();
        $array['tags'] = array_map(function($item) {
          return $item['tag'];
        }, PhoneTag::where('phone_id', $phone->id)->get()->toArray());



        return $this->response->array($array);
    }
    public function listPhones(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
      $workspace = $workspace = $this->getWorkspace($request); 
        $phones = Phone::select(DB::raw("phones_definitions.manufacturer, phones_definitions.model, phones.public_id, phones.id, phones.mac_address, phones.name, phones_groups.name AS `group`"));
        $phones = $phones->join('phones_definitions', 'phones_definitions.phone_type', '=', 'phones.phone_type');
        $phones = $phones->leftJoin('phones_groups', 'phones_groups.id', '=', 'phones.group_id');
        $phones = $phones->where('phones.workspace_id', $workspace->id);
        MainHelper::addSearch($request, $phones, ['name']);
        return $this->response->paginator($phones->paginate($paginate), new PhoneTransformer);
    }

    public function deletePhone(Request $request, $phoneId)
    {
        $phone = Phone::findOrFail($phoneId);
        if (!$this->hasPermissions($request, $phone, 'manage_phones')) {
            return $this->response->errorForbidden();
        }
        $phone->delete();
   }
    public function updatePhone(Request $request, $phoneId)
    {
        $phone = Phone::where('public_id', $phoneId)->firstOrFail();
        if (!$this->hasPermissions($request, $phone, 'manage_phones')) {
            return $this->response->errorForbidden();
        }
        $data = $request->json()->all();
        $tags = $data['tags'];
        unset( $data['tags'] );
        $phone->update($data);
        PhoneTag::updateModelTags($tags, $phone->id);
   }
    public function phoneDefs(Request $request)
    {
        $defs= PhoneDefinition::all()->toArray();
        return $this->response->array($defs);
    }
    public function savePhone(Request $request)
    {
        $data = $request->all();
        $tags = $data['tags'];
        unset( $data['tags'] );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_phone')) {
          return $this->errorPerformingAction();
        }
        $params = [
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'name' => $data['name'],
              'mac_address' => $data['mac_address'],
              'phone_type'=> $data['phone_type'],
              'group_id' => NULL,
              'needs_provisioning' => TRUE
        ];
        if (!is_null($data['group_id'])) {
          $params['group_id'] = $data['group_id'];
        }
        $phone = Phone::create($params);
        PhoneIndividualSetting::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'phone_id' => $phone->id,
        ]);
        $phoneDef = PhoneDefinition::where('phone_type', $data['phone_type'])->first();
        PhoneTag::updateModelTags($tags, $phone->id);
            $mail = Config::get("mail");
            $data = compact('phone', 'phoneDef');
            Mail::send('emails.phone_created', $data, function ($message) use ($user, $mail) {
                $message->to($user->email);
                $message->subject("Phone Created");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
        return $this->response->noContent()->withHeader('X-Phone-ID', $phone->id);
    }

}

