<?php

namespace App\Http\Controllers\Api;
use \App\Http\Controllers\Controller;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Workspace;
use App\WorkspaceUser;
use App\Extension;
use App\DIDNumber;
use App\Flow;
use App\Call;
use App\Recording;
use App\User;
use App\ErrorUserTrace;
use Config;
use Exception;



class ApiAuthController extends ApiController {
     use Helpers;
     public static $user = NULL;
     public static $workspace = NULL;
     public function __construct() {
          //parent::__construct();
          if (!$this->auth) {
               // fail
          }
     }

     public function getWorkspace(Request $request, $soft=FALSE) {
          $id = $request->header('X-Workspace-ID');

          if (!is_null( ApiAuthController::$workspace) ) {
               return ApiAuthController::$workspace;
          }


          if ( $soft ) {
               $workspace = Workspace::find($id);
          } else {
               $workspace = Workspace::findOrFail($id);
          }

          $user = $this->getUser($request);
          $userCount = WorkspaceUser::where('user_id', $user->id)
                    ->where('workspace_id', $workspace->id)
                    ->count();
          if (!($workspace->creator_id == $user->id || $userCount > 0)) {
               throw new Exception('workspace access denied.');
          }

          ApiAuthController::$workspace = $workspace;

          return $workspace;
     }
     public function getWorkspaceUserWithAllData(Request $request, $user=NULL, $soft=FALSE) {
          $id = $request->header('X-Workspace-ID');
          $data = WorkspaceUser::select(array('workspaces_users.*', 'workspaces.*', 'user_email_options.*'));
          $data->join('workspaces', 'workspaces.id', '=', 'workspaces_users.workspace_id');
          $data->join('user_email_options', 'user_email_options.user_id', '=', 'workspaces_users.id');
          if (!empty($user)) {
               $data->where('workspaces_users.user_id', '=', $user->id);
          }

          $data->where('workspaces_users.workspace_id', '=', $id);

          $workspace = $data->firstOrFail();

          return $workspace;
     }
    public function getUser(Request $request, $soft=FALSE) {

          if (!is_null( ApiAuthController::$user) ) {
               return ApiAuthController::$user;
          }

          $admin = $request->header('X-Admin-Token');
          $workspaceId = $request->header('X-Workspace-ID');
          $adminThings = Config::get("admin");
          if ( !empty( $admin ) && $admin == $adminThings['frontend_token']) {
               $workspace = Workspace::findOrFail($workspaceId);
               if ($soft) {
                    $user = User::find($workspace->creator_id);
               } else {
                    $user = User::findOrFail($workspace->creator_id);
               }

               ApiAuthController::$user = $user;

               return $user;
          }
          $user = NULL;
          $headers = apache_request_headers();
          $token = NULL;
          foreach ( $headers as $key => $value ) {
               $lower = strtolower($key);
               if ( $lower == 'authorization' ) {
                    $token = $value;
               }
          }
              
          //$token = $headers['authorization'];

           if (!empty($token)) {
             $parts = explode(" ", $token);
             $user = JWTAuth::authenticate($parts[1]);
          }


          ApiAuthController::$user = $user;

          return $user;
     }

}
