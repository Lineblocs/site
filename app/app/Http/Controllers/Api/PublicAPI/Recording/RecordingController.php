<?php

namespace App\Http\Controllers\Api\PublicAPI\Recording;
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
use \DB;
use Mail;
use Config;



class RecordingController extends ApiPublicController {
    public function post(Request $request)
    {
    }
    public function put(Request $request, $extensionId)
    {
    }

    public function get(Request $request, $extensionId)
    {
    }
    public function list(Request $request)
    {
    }
    public function delete(Request $request, $extensionId)
    {
    }


}

