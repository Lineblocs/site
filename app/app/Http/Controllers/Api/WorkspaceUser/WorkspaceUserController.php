<?php 
namespace App\Http\Controllers\Api\WorkspaceUser;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Flow;
use \App\FlowTemplate;
use \App\Transformers\FlowTransformer;
use \App\Transformers\FlowTemplateTransformer;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\User\UserWorkflow;
use App\WorkspaceUser;
use DB;
use Mail;
use Config;

class WorkspaceUserController extends ApiAuthController {
    use UserWorkflow;
}

