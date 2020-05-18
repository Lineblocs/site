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
use \App\Helpers\WorkflowTraits\Recording\RecordingWorkflow;
use \DB;
use Mail;
use Config;



class RecordingController extends ApiPublicController {
  use RecordingWorkflow;
    public function list(Request $request)
    {
        return $this->listRecordings($request);
    }
    public function delete(Request $request, $recordingId)
    {
        return $this->deleteRecording($request, $recordingId);
    }


}

