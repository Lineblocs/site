<?php 
namespace App\Http\Controllers\Api\WorkspaceRoutingACL;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\Param;
use \App\Flow;
use \App\FlowTemplate;
use \App\Transformers\FlowTransformer;
use \App\Transformers\FlowTemplateTransformer;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkspaceHelper;
use App\WorkspaceRoutingACL;
use App\SIPRoutingACL;
use DB;
use Log;

class WorkspaceRoutingACLController extends ApiAuthController {
    public function listACLs(Request $request)
    {
      $workspace = $this->getWorkspace( $request );
        $data = WorkspaceHelper::getACLs($workspace);
        return $this->response->array($data);
    }
    public function saveACLs(Request $request)
    {
        $data = $request->json()->all();
        $workspace = $this->getWorkspace($request);
        $user = $this->getUser($request);
        /*
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_workspace_acls')) {
            return $this->response->errorForbidden();
        }
        */
        Log::info("looking up ACLs for workspace: " . $workspace->id);
        $currentACLs = WorkspaceRoutingACL::where('workspace_id', '=', $workspace->id)->get();
        foreach ($data as $item) {
          Log::info("updating ACL record: " . json_encode( $item ));
          $attrs = $item;
          $found = FALSE;
          if (!empty($item['id'])) {
            unset($attrs['id']);
            foreach ($currentACLs as $acl) {
              $item_id = (int) $item['id'] ;
              Log::info("comparing " . $item_id . " with " . $acl['id']);
              if ( $acl['id'] == $item_id ) {
                Log::info("updating id: " . $acl['routing_acl_id']);
                Log::info("updating: " . json_encode( $attrs ));
                $acl->update($attrs);
              }
            }
          } else {
            // ensure the routing_acl_id is there
            Log::info("creating new acl record: " . json_encode( $attrs ));
            $attrsToCreate = $attrs;
            $attrsToCreate['workspace_id'] = $workspace->id;
            $newParam = WorkspaceRoutingACL::create($attrsToCreate);
          }
        }

        return $this->response->noContent();
    }

}

