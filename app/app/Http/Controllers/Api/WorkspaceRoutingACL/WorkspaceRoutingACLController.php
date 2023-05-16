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

class WorkspaceRoutingACLController extends ApiAuthController {
    public function listACLs(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $acls = SIPRoutingACL::select(array(
            'sip_routing_acl.iso',
            'sip_routing_acl.name',
            'sip_routing_acl.risk_level',
            DB::raw('sip_routing_acl.enabled, preset_acl_enabled'),
            'workspace_routing_acl.enabled'
        ));
        $acls->leftJoin('workspace_routing_acl',
          'workspace_routing_acl.routing_acl_id',
          '=',
          'sip_routing_acl.id');
        $acls->where('workspace_routing_acl.workspace_id', $workspace->id);
        $data = $acls->get()->toArray(); 
        return $this->response->array($acls);
    }
    public function saveACLs(Request $request)
    {
        $data = $request->json()->all();
        $workspace = $this->getWorkspace($request);
        $user = $this->getUser();
        $params = WorkspaceRoutingACL::where('workspace_id', '=', $workspace->id)->get();
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_workspace_acls')) {
            return $this->response->errorForbidden();
        }
        $currentACLs = WorkspaceRoutingACL::where('workspace_id', '=', $workspace->id)->get();
        foreach ($data as $item) {
          $attrs = $item;
          if (isset($item['id']) && !empty($item['id'])) {
            unset($attrs['id']);
            foreach ($currentACLs as $acl) {
              if ( $acl['id'] == $item['id'] ) {
                $param->update($attrs);
              }
            }
          } else {
            // ensure the routing_acl_id is there
            $attrsToCreate = $attrs;
            $attrsToCreate['workspace_id'] = $workspace->id;
            $newParam = WorkspaceRoutingACL::create($attrsToCreate);
          }
        }

        return $this->response->noContent();
    }

}

