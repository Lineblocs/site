<?php

namespace App\Http\Controllers\Api\PublicAPI\User;
use \App\Http\Controllers\Api\ApiPublicController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\AppLogin;
use \App\DIDNumber;
use \App\DIDNumberTag;
use \App\UserDebit;
use \App\Flow;
use \App\ServicePlan;
use \App\Workspace;
use \App\WorkspaceUser;
use \App\Transformers\DIDNumberTransformer;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkflowTraits\User\UserWorkflow;
use Auth;
use \DB;
use Mail;
use Config;
use DateTime;
use Log;




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

      if (!$token = $token = JWTAuth::fromUser($user)) {
          return response()->json(['error' => 'invalid_credentials'], 401);
      }
    return $this->response->array([
        'success' => TRUE,
        'userId' => $user->id,
        'workspace' => $workspace->toArrayWithRoles($user),
        'apiDetails' => $apiDetails,
            'token' => MainHelper::createJWTPayload($token),
            'user' => $user->toArray()
    ]);
    }
    public function requestLoginToken(Request $request) {
      Log::info("requestLoginToken called");
        $data = $request->json()->all();
        $credentials = [
          'email' => $data['email'],
          'password' => $data['password']
        ];
      Log::info("requestLoginToken email = " . $credentials['email']);
        $appName = $data['app_name'];

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            \Log::info("error occured: " . $e->getMessage());
            return $this->errorInternal($request, 'Could not create token');
        }
        $currentUser = Auth::user();
        // check if the user is confirmed
        /*
        if (!$currentUser->confirmed) {
          return $this->response->errorForbidden('email is not verified');
        }
        */
        AppLogin::create([
          'user_id' => $currentUser->id,
          'app_name' => $appName,
          'datetime' => new DateTime()
        ]);

        $result = [
            'token' => MainHelper::createJWTPayload($token),
            'user' => $currentUser->toArray()
        ];
        return $this->response->array($result);
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

