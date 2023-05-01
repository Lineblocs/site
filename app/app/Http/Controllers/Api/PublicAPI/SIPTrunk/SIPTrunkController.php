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
    public function post(Request $request)
    {
      return $this->saveExtension($request);
    }
    public function put(Request $request, $extensionId)
    {
      return $this->updateExtension($request, $extensionId);
    }

    public function get(Request $request, $extensionId)
    {
      return $this->extensionData($request, $extensionId);
    }
    public function list(Request $request)
    {
      return $this->listExtensions($request);
    }
    public function delete(Request $request, $extensionId)
    {
      return $this->deleteExtension($request, $extensionId);
    }

}

