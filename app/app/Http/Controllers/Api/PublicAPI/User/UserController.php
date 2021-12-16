<?php

namespace App\Http\Controllers\Api\PublicAPI\User;
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
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\User\UserWorkflow;
use \DB;
use Mail;
use Config;




class UserController extends ApiPublicController {
    use UserWorkflow;
    public function post(Request $request)
    {
        return $this->addUser($request);
    }
    public function put(Request $request, $userId)
    {
        return $this->updateUser($request, $userId);
    }

    public function get(Request $request, $userId)
    {
        return $this->userData($request, $userId);
    }
    public function list(Request $request)
    {
        return $this->listUsers($request);
    }
    public function delete(Request $request, $userId)
    {
        return $this->deletetUser($request, $userId);
    }


}

