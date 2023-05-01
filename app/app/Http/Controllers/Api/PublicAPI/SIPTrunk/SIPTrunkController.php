<?php

namespace App\Http\Controllers\Api\PublicAPI\SIPTrunk;
use \App\Http\Controllers\Api\ApiPublicController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SIPTrunk;
use \App\Transformers\TrunkTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\WorkflowTraits\SIPTrunk\SIPTrunkWorkflow;
use \DB;
use Mail;
use Config;


class SIPTrunkController extends ApiPublicController {
    use SIPTrunkWorkflow;
}

