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



class ApiAuthController extends ApiController {
     use Helpers;
     public function __construct() {
          //parent::__construct();
          if (!$this->auth) {
               // fail
          }
     }

     public function getWorkspace(Request $request, $soft=FALSE) {
          $id = $request->header('X-Workspace-ID');
          if ( $soft ) {
               $workspace = Workspace::find($id);
          } else {
               $workspace = Workspace::findOrFail($id);
          }
          return $workspace;
     }
    public function getUser(Request $request, $soft=FALSE) {
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

          return $user;
     }

}
