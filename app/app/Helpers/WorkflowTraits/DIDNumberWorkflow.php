<?php

namespace App\Helpers\WorkflowTraits\DIDNumber;
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
use App\NumberService\NumberService;
use \App\Helpers\MainHelper;
use \DB;
use Mail;
use Config;



trait DIDNumberWorkflow {
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