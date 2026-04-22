<?php 
namespace App\Http\Controllers\Api\WorkspaceUser;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Flow;
use \App\FlowTemplate;
use \App\WorkspaceRole;
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

    public function getWorkspaceRoles(Request $request)
    {
        $data = $request->json()->all();
        $roles = WorkspaceRole::all();
        return $this->response->array([
            'roles' => $roles->toArray()
        ]);
    }
}

