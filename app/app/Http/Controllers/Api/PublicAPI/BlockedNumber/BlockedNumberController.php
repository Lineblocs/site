<?php

namespace App\Http\Controllers\Api\PublicAPI\BlockedNumber;
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
use \App\NumberService\NumberService;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\BlockedNumber\BlockedNumberWorkflow;
use \DB;
use Mail;
use Config;



class BlockedNumberController extends ApiPublicController {
  use BlockedNumberWorkflow;
    public function post(Request $request)
    {
      return $this->postNumber($request);
    }
    public function list(Request $request)
    {
      return $this->getNumbers($request);
    }
    public function delete(Request $request, $numberId)
    {
      return $this->deleteNumber($request, $numberId);
    }


}

