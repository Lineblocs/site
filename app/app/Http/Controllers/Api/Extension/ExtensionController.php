<?php

namespace App\Http\Controllers\Api\Extension;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Extension;
use \App\ExtensionTag;
use \App\Flow;
use \App\Transformers\ExtensionTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\WorkflowTraits\Extension\ExtensionWorkflow;
use \DB;
use Mail;
use Config;



class ExtensionController extends ApiAuthController {
    use ExtensionWorkflow;
}

