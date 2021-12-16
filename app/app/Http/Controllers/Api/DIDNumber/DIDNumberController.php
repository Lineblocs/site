<?php

namespace App\Http\Controllers\Api\DIDNumber;
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
use \App\NumberService\NumberService;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\DIDNumber\DIDNumberWorkflow;
use \DB;
use Mail;
use Config;



class DIDNumberController extends ApiAuthController {
    use DIDNumberWorkflow;
    public function availableNumbers(Request $request)
    {
    /*
        $amount = 50;
        if ($request->get("amount")) {
          $amount = (int) $request->get("amount");
        }
    */
        $params = $request->only('country_iso', 'region', 'prefix', 'rate_center', 'number_for', 'number_type', 'vanity_prefix', 'vanity_pattern');
        $extra = array(
            'number_for' => $params['number_for'],
            'number_type' => $params['number_type'],
            'vanity_prefix' => $params['vanity_prefix'],
            'vanity_pattern' => $params['vanity_pattern'],
        );
        $numbers = NumberService::listNumbers($params['country_iso'], $params['region'], $params['prefix'], $params['rate_center'], $extra);
        return $this->response->array($numbers);
    }
    public function saveNumber(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $number = $data['number'];
        $apiNumber = $data['api_number'];
        $region = '';
        $cost = $data['monthly_cost'];
        $setup_cost = $data['setup_cost'];
        $provider = $data['provider'];
        $country = $data['country'];
        $features = $data['features'];
        $type = $data['type'];
        if ($type=='local') {
            $region = $data['region'];
        }
        list($buying, $message) = $user->canBuyNumber($workspace, $user, $number, $cost);
        if (!$buying) {
          return $this->response->array(['success' => FALSE, 'message' => "Cannot buy number because: " . $message]);
        }

          $providerObj = NumberService::getProvider($provider);

          $register = $providerObj->register($workspace, $type, $apiNumber);
        if ($register) {
            $monthlyCost = "";
            $params = [
                'user_id' => $user->id,
                'workspace_id' => $workspace->id,
                'number' => $number,
                'api_number' => $apiNumber,
                'region' => $region,
                'monthly_cost' => MainHelper::toCents($cost),
                'setup_cost' => MainHelper::toCents($setup_cost),
                'provider' => $provider,
                'country' => $country,
                'features' => $features,
                'type' => $type,
                'did_action' => 'accept-call'
            ];
             $params['availability'] = 'ready-to-use'; 
            if ($type=='vanity') {
             $params['availability'] = 'pending-in-review';
            }

            if ($user->trial_mode) {
              $params['trial_number'] = TRUE;
            }
            $number = DIDNumber::create($params);
            $debit = UserDebit::create([
              'source' => 'NUMBER_RENTAL',
              'cents' => MainHelper::toCents($cost),
              'user_id' => $user->id,
              'status' => 'pending',
              'module_id' => $number->id
            ]);
         
            $flow = Flow::create([
              'name' => 'Flow for ' . $number->number,
              'user_id' => $user->id,
              'flow_json' => null,
              'started' => false,
              'workspace_id' => $workspace->id,
              'user_id' => $user->id
            ]);
            $number->update([
              'flow_id' => $flow->id
            ]);
            $mail = Config::get("mail");
            $data = array(
              "did" => $number
            );
            Mail::send('emails.did_purchased', $data, function ($message) use ($user, $mail) {
                $message->to($user->email);
                $message->subject("DID Purchased");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
            return $this->response->array(['success' => TRUE, 'number' => $number->toArray()])->withHeader('X-Number-ID', $number->public_id);
        }
        return $this->errorInternal($request, 'DID register error');
    }


}

