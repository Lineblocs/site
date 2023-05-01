<?php

namespace App\Http\Controllers\Api\SIPTrunk;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SIPTrunk;
use \App\SIPTrunkOrigination;
use \App\SIPTrunkOriginationEndpoint;
use \App\SIPTrunkTermination;
use \App\SIPTrunkTerminationAcl;
use \App\SIPTrunkTerminationCredential;
use \App\DIDNumber;
use \App\Transformers\TrunkTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use \App\Helpers\DNSHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\WorkflowTraits\SIPTrunk\SIPTrunkWorkflow;
use App\Exceptions\DIDNumberAllocatedException;
use \DB;
use Mail;
use Config;
use Exception;

class SIPTrunkController extends ApiAuthController {
    use SIPTrunkWorkflow;
}

