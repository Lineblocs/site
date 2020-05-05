<?php 
namespace App\Http\Controllers\Api\WorkspaceParam;
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
use App\WorkspaceParam;
use DB;

class WorkspaceParamController extends ApiAuthController {
    public function listParams(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $params =  WorkspaceParam::where('workspace_id', $workspace->id)->get()->toArray();
        return $this->response->array($params);
    }
    public function saveParams(Request $request)
    {
        $data = $request->json()->all();
        $workspace = $this->getWorkspace($request);
        $user = $this->getUser();
        $params = WorkspaceParam::where('workspace_id', '=', $workspace->id)->get();
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_params')) {
            return $this->response->errorForbidden();
        }
        foreach ($data as $item) {
          $attrs = $item;
          if (isset($item['id']) && !empty($item['id'])) {
            unset($attrs['id']);
            foreach ($params as $param) {
              if ( $param['id'] == $item['id'] ) {
                $param->update($attrs);
              }
            }
          } else {
            $attrsToCreate = $attrs;
            $attrsToCreate['workspace_id'] = $workspace->id;
            $newParam = WorkspaceParam::create($attrsToCreate);
          }
        }
        foreach ($params as $param) {
          $found = FALSE;
          foreach ( $data as $item ) {
            if ((isset($item['id']) && !empty($item['id'])) && $item['id'] == $param->id) {
              $found = TRUE;
            }
          }
          if (!$found) {
            $param->delete();
          }
        }
             
        return $this->response->noContent();
    }

}

