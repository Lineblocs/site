<?php

namespace App\Http\Controllers\Api\Settings;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\VerifiedCallerId;
use \App\Transformers\VerifiedCallerIdTransformer;
use \App\Helpers\MainHelper;
use \Config;
use \Twilio\Rest\Client;
use \Exception;



class VerifiedCallerIdsController extends ApiAuthController {
    public function getVerified(Request $request)
    {
        $user = $this->getUser($request);
        $numbers = VerifiedCallerId::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array($numbers);
    }
    public function postVerified(Request $request)
    {
        $data = $request->all();
        $number = $data['number'];
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $code = rand(100000, 999999); 
        $twilio= Config::get('twilio');
        $client = new Client($twilio['account_sid'], $twilio['auth_token']);
        $message = sprintf("Your Lineblocs Caller ID verification code is %s", $code);
        try {
            $client->messages->create(
                // Where to send a text message (your cell phone?)
            $number,
                array(
                    'from' => $twilio['verification_number'],
                    'body' => $message
                )
            );

            VerifiedCallerId::create([
                'user_id' => $user->id,
                'workspace_id' => $workspace->id,
                'code' => $code,
                'number' => MainHelper::toE164($data['number'])
            ]);
        } catch (Exception $ex) {
            return $this->errorInternal($request, 'Could not validate number..');

        }
        return $this->response->noContent();
    }
    public function postVerifiedConfirm(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $formattedNumber = MainHelper::toE164($data['number']);

        $number = VerifiedCallerId::where('number', '=', $formattedNumber)->where('user_id', '=', $user->id)->firstOrFail();
        if ($number->code == $data['code']) {
            $number->update(['confirmed' => TRUE]);
            return $this->response->array(['success' => TRUE]);
        }
        return $this->response->array(['success' => FALSE]);
    }
    public function deleteVerified(Request $request, $numberId)
    {
        $data = $request->json()->all();
        $number = VerifiedCallerId::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_verified_caller_ids')) {
            return $this->response->errorForbidden();
        }
        $number->delete();
        return $this->response->noContent();
    }


}

