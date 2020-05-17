<?php

namespace App\Http\Controllers\Api\PublicAPI\DIDNumber;
use \App\Http\Controllers\Api\ApiPublicController;
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
use \App\Helpers\WorkflowTraits\DIDNumber\DIDNumberWorkflow;
use \DB;
use Mail;
use Config;




class DIDNumberController extends ApiPublicController {
    use DIDNumberWorkflow;
    public function put(Request $request, $numberId)
    {
        return $this->updateNumber($request, $numberId);
    }
    public function get(Request $request, $numberId)
    {
        return $this->numberData($request, $numberId);
    }
    public function list(Request $request)
    {
        \Log::info("listing DIDs..");
        return $this->listNumebrs($request);
    }
    public function delete(Request $request, $numberId)
    {
        return $this->deleteNumber($request, $numberId);
    }


}

