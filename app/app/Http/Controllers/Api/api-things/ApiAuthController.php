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
use Config;



class ApiAuthController extends ApiController {
     use Helpers;
     public function __construct() {
          //parent::__construct();
          if (!$this->auth) {
               // fail
          }
     }

     public function getWorkspace(Request $request) {
          $id = $request->header('X-Workspace-ID');
          $workspace = Workspace::findOrFail($id);
          return $workspace;
     }
     public function getUser(Request $request) {
          $admin = $request->header('X-Admin-Token');
          $workspaceId = $request->header('X-Workspace-ID');
          $adminThings = Config::get("admin");
          if ( !empty( $admin ) && $admin == $adminThings['token']) {
               $workspace = Workspace::findOrFail($workspaceId);
               $user = User::findOrFail($workspace->creator_id):
               return $user;
          }

          $user = $this->auth->user();
          return $user;
     }
     public function hasPermissions($request, $resource, $action) {
          $workspace = $this->getWorkspace($request);
          $user = $this->getUser($request);
          $info = WorkspaceUser::where('workspace_id', $workspace->id)
                         ->where('user_id', $user->id);
          if (!$info) {
               return FALSE;
          }
          if ($resource->workspace_id != $workspace->id) {
               return FALSE;
          }
          if ($resource->workspace_id == $workspace->id && $workspace->creator_id == $user->id) {
               return TRUE;
          }
          // check actions
          if ($resource instanceof Extension && $resource->user_id == $user->id && $action == 'manage_extensions') {
               return TRUE;
          }
          if ($resource instanceof DIDNumber && $resource->user_id == $user->id && $action == 'manage_dids') {
               return TRUE;
          }

          return FALSE;
     }
     public function errorPerformingAction() {
          return $this->response->errorForbidden("Cannot perform action..");
     }
    public function checkAdminAuth(Request $request) {
         $auth = $request->header("X-Admin-Token");
         $admin = Config::get("admin");
         if ($admin['frontend_token']!=$auth){
              return FALSE;
         }
         return TRUE;
    }
}
