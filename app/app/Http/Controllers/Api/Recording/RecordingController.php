<?php

namespace App\Http\Controllers\Api\Recording;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Recording;
use \App\RecordingTag;
use \App\Transformers\RecordingTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkflowTraits\Recording\RecordingWorkflow;



class RecordingController extends ApiAuthController {
  use RecordingWorkflow;
}

