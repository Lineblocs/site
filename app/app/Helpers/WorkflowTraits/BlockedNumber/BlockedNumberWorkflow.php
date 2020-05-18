<?php

namespace App\Helpers\WorkflowTraits\BlockedNumber;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\DIDNumber;
use \App\DIDNumberTag;
use \App\UserDebit;
use \App\Flow;
use \App\Transformers\DIDNumberTransformer;
use \App\ThirdParty\NumberService;
use \App\Helpers\MainHelper;
use \DB;
use Mail;
use Config;



trait BlockedNumberWorkflow {
   public function getNumbers(Request $request)
    {
        $user = $this->getUser($request);
        $numbers = BlockedNumber::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array($numbers);
    }
    public function postNumber(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $data = $request->all();
        BlockedNumber::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'number' => $data['number']
        ]);
        return $this->response->noContent();
    }
    public function deleteNumber(Request $request, $numberId)
    {
        $data = $request->json()->all();
        $number = BlockedNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_blocked_numbers')) {
            return $this->response->errorForbidden();
        }
        $number->delete();
        return $this->response->noContent();
    }
}
