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






class ApiController extends Controller {
   use Helpers;
   public function getJWTUser() {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
   }
   public function makeApiLocation($path) {
        return "/api/".$path;
   }
   public function getPaginate($request)
   {
     if ($request->has("per_page")) {
          return (int)$request->get("per_page");
     }
     return 20;
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

    public function errorInternal(Request $request, $message='') {
          $user = $this->getUser( $request, TRUE );
          $workspace = $this->getWorkspace( $request, TRUE );
          $params = [
               'message' => $message
          ];
          if ($user) {
               $params['user_id'] = $user->id;
          }
          if ($workspace) {
               $params['workspace_id'] = $workspace->id;
          }

          $params['full_url'] = $request->fullUrl();
          $error = ErrorUserTrace::create($params);
          header('X-ErrorCode-ID: '. $error->id);

          return $this->response->errorInternal( $message );
    }
   public function sendPaginationResults($request, $resources, $paginate, $transformer) {
      $all = $request->get("all");
      if ($all) {
        return $this->response->collection($resources->get(),$transformer);
      }
      return $this->response->paginator($resources->paginate($paginate), $transformer);
   }

}
