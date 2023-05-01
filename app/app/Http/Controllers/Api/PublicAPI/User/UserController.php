<?php

namespace App\Http\Controllers\Api\PublicAPI\User;
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
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\User\UserWorkflow;
use \DB;
use Mail;
use Config;




class UserController extends ApiPublicController {
    use UserWorkflow;

    public function createUser(Request $request)
    {
        $data = $request->json()->all();
        $email = $data['email'];
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            return $this->response->array([
            'success' => FALSE,
            'message' => 'Email was invalid..'
          ]);
        }
        $exists = User::where('email', $email)->first();
        if ($exists) {
          return $this->response->array([
            'success' => FALSE,
            'message' => 'User with this email already exists..'
          ]);
        }
        $externalUser = TRUE;
        $user = MainHelper::createUser($data, $externalUser);
        $unique = uniqid(TRUE);
        $plan = ServicePlan::getPayAsYouGoplan();
        $apiToken = MainHelper::createAPIToken();
        $apiSecret = MainHelper::createAPISecret();
        $workspace = Workspace::create([
        'creator_id' => $user->id,
        'name' => $unique,
        'api_token' => $apiToken,
        'api_secret' => $apiSecret,
        'plan' => $plan->key_name,
        'trial_mode' => FALSE,
        'external_app_workspace' => TRUE
      ]);
      WorkspaceUser::createSuperAdmin($workspace, $user, ['accepted' => TRUE]);
      //WorkspaceEvent::addEvent($workspace, 'WORKSPACE_CREATED');
      $apiDetails = [
        'token' => $apiToken,
        'secret' => $apiSecret
      ];
    return $this->response->array([
        'success' => TRUE,
        'userId' => $user->id,
        'workspace' => $workspace->toArrayWithRoles($user),
        'apiDetails' => $apiDetails
    ]);
    }
    public function validateLogin(Request $request) {
        // just validating the HTTP basic auth here
        $user = $this->getUser($request);
        if ( !$user ) {
          return $this->response->array([
            'success' => FALSE,
            'message' => 'Authentication failed.'
          ]);
        }
        return $this->response->array([
            'success' => TRUE
        ]);
    }
    public function post(Request $request)
    {
        return $this->addUser($request);
    }
    public function put(Request $request, $userId)
    {
        return $this->updateUser($request, $userId);
    }

    public function get(Request $request, $userId)
    {
        return $this->userData($request, $userId);
    }
    public function list(Request $request)
    {
        return $this->listUsers($request);
    }
    public function delete(Request $request, $userId)
    {
        return $this->deletetUser($request, $userId);
    }


}

