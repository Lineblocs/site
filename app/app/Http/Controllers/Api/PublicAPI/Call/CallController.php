<?php

namespace App\Http\Controllers\Api\PublicAPI\Call;
use \App\Http\Controllers\Api\ApiPublicController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Recording;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;
use App\Helpers\MainHelper;
use App\Helpers\WorkflowTraits\Call\CallWorkflow;


class CallController extends ApiPublicController {
    use CallWorkflow;
    public function get(Request $request, $callId)
    {
        return $this->callData($request, $callId);
    }
    public function list(Request $request)
    {
        \Log::info("listing Calls..");
        return $this->listCalls($request);
    }
    public function delete(Request $request, $callId)
    {
        return $this->deleteCall($request, $callId);
    }
}

