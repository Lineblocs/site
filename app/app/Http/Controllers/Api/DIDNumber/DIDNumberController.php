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
use \App\ThirdParty\NumberService;
use \App\Helpers\MainHelper;
use \DB;
use Mail;
use Config;



class DIDNumberController extends ApiAuthController {
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
        $provider = $data['provider'];
        $country = $data['country'];
        $features = $data['features'];
        $type = $data['type'];
        if ($type=='local') {
            $region = $data['region'];
        }
        list($buying, $message) = $user->canBuyNumber($user, $number, $cost);
        if (!$buying) {
          return $this->response->array(['success' => FALSE, 'message' => "Cannot buy number because: " . $message]);
        }

          $providerObj = NumberService::getProvider($provider);

          $register = $providerObj->register($type, $apiNumber);
        if ($register) {
            $monthlyCost = "";
            $params = [
                'user_id' => $user->id,
                'workspace_id' => $workspace->id,
                'number' => $number,
                'api_number' => $apiNumber,
                'region' => $region,
                'monthly_cost' => $cost,
                'provider' => $provider,
                'country' => $country,
                'features' => $features,
                'type' => $type
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
    public function updateNumber(Request $request, $numberId)
    {
        $data = $request->all();
        $tags = $data['tags'];
        unset($data['tags']);
        $number = DIDNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_dids')) {
            return $this->response->errorForbidden();
        }
        if (isset($data['flow_id'])) {
            $flow = Flow::findOrFail($data['flow_id']);
            if (!$this->hasPermissions($request, $number, 'manage_flows')) {
                return $this->response->errorForbidden();
            }
        }
        $number->update($data);
        DIDNumberTag::updateModelTags($tags, $number->id);
    }
    public function numberData(Request $request, $numberId)
    {
        $number = DIDNumber::select(DB::raw("did_numbers.*, flows.id AS flow_id, flows.public_id AS flow_public_id"));
        $number->leftJoin('flows', 'flows.id', '=', 'did_numbers.flow_id');
        $number = $number->where('did_numbers.public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_flows')) {
            return $this->response->errorForbidden();
        }
        $array = $number->toArray();
        $array['tags'] = array_map(function($item) {
          return $item['tag'];
        }, DIDNumberTag::where('number_id', $number->id)->get()->toArray());

        return $this->response->array($array);
    }
    public function listNumbers(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $numbers = DIDNumber::where('user_id', $user->id);
        MainHelper::addSearch($request, $numbers, ['number', 'region']);
        return $this->response->paginator($numbers->paginate($paginate), new DIDNumberTransformer);
    }
    public function deleteNumber(Request $request, $numberId)
    {
        $data = $request->json()->all();
        $number = DIDNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_dids')) {
            return $this->response->errorForbidden();
        }
        //add unrenting
        $provider = NumberService::getProvider($number->provider);
        $status = $provider->unrent($number->api_number);
        if (!$status) {
            return $this->errorInternal($request, 'Number unrent error');
        }
        $number->delete();
        return $this->response->noContent();
    }


}

