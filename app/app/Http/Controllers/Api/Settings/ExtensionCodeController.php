<?php

namespace App\Http\Controllers\Api\Settings;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\ExtensionCode;
use \App\Transformers\ExtensionCoderansformer;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkspaceHelper;



class ExtensionCodeController extends ApiAuthController {
    public function getExtensionCodes(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $codes = ExtensionCode::where('workspace_id', '=', $workspace->id)->get()->toArray();


        return $this->response->array($codes);
    }
    public function postExtensionCodes(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $data = $request->all();
       if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_extension_codes')) {
          return $this->errorPerformingAction();
        }
        $codes = $data['codes'];
        $current = ExtensionCode::where('workspace_id', $workspace->id)->get();
        foreach ($codes as $code) {
          $params = $code;
          if (!empty($code['id'])) {
            foreach ($current as $value) {
              if ($value->id == $code['id']) {
                $value->update( $params );
              }
            }
          } else {
            ExtensionCode::create(array_merge($params, [
              'workspace_id' => $workspace->id,
              'user_id' => $user->id
            ]));
          }
        }        
        foreach ($current as $item) {
          $found = FALSE;
          foreach ($codes as $code) {
            if (!empty($code['id']) && $code['id'] == $item->id) {
              $found = TRUE;
            }
          }
          if (!$found) {
            $item->delete(); 
          }
        }
            
        return $this->response->noContent();
    }
    public function deleteipWhitelist(Request $request, $ipId)
    {
        $data = $request->json()->all();
        $ip  = IpWhitelist::where('public_id', '=', $ipId)->firstOrFail();
        if (!$this->hasPermissions($request, $ip, 'manage_ip_whitelist')) {
            return $this->response->errorForbidden();
        }
        $ip->delete();
        return $this->response->noContent();
    }


}

