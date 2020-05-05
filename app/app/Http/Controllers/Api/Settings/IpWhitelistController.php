<?php

namespace App\Http\Controllers\Api\Settings;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\IpWhitelist;
use \App\Transformers\VerifiedCallerIdTransformer;
use \App\Helpers\MainHelper;



class IpWhitelistController extends ApiAuthController {
    public function getIpWhitelist(Request $request)
    {
        $user = $this->getUser($request);
        $ips = IpWhitelist::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array($ips);
    }
    public function postIpWhitelist(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $data = $request->all();
        IpWhitelist::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'ip' => $data['ip'],
            'range' => $data['range']
        ]);
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

