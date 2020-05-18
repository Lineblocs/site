<?php

namespace App\Http\Controllers\Api\PublicAPI\BYO\DIDNumber;
use \App\Http\Controllers\Api\ApiPublicController;
use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYODIDNumber; 
use \App\BYODIDNumberRoute; 
use \App\Transformers\BYODIDNumberTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\WorkflowTraits\BYO\DIDNumberWorkflow;
use Mail;
use Config;
use File;





class DIDNumberController extends ApiPublicController {
    use DIDNumberWorkflow;
    public function post(Request $request)
    {
        return $this->saveNumber($request);
    }

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
        return $this->listNumbers($request);
    }
    public function delete(Request $request, $numberId)
    {
        return $this->deleteNumber($request, $numberId);
    }


}

