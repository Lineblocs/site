<?php 
namespace App\Http\Controllers\Api\Flow;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Flow;
use \App\FlowTemplate;
use \App\MacroFunction;
use \App\Transformers\FlowTransformer;
use \App\Transformers\FlowTemplateTransformer;
use \App\Helpers\MainHelper;



class FlowController extends ApiAuthController {
    public function saveFlow(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $category = 'extension';
        $json = $data['flow_json'];

        if (!empty($data['category'])) {
            $category = $data['category'];
        }
        if ($data['template_id']) {
          $flow = Flow::createFromTemplate( $data['name'], $user, $workspace, FlowTemplate::findOrFail($data['template_id'] ), $category);
        } else {
          $flow = Flow::create([
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'name' => $data['name'],
              'flow_json' => $json,
              'category' => $category,
              'started' => TRUE
          ]);
        }

        return $this->response->array($flow->toArray())->withHeader('X-Flow-ID', $flow->public_id);
    }
    public function updateFlow(Request $request, $flowId)
    {
        $data = $request->json()->all();
        $flow = Flow::where('public_id', '=', $flowId)->firstOrFail();
        if (!$this->hasPermissions($request, $flow, 'manage_flows')) {
            return $this->response->errorForbidden();
        }
        if (isset($data['template_id'])) {
          $template = FlowTemplate::findOrFail($data['template_id']);
          $json = $template->flow_json;
        } else {
          $json = $data['flow_json'];
        }
        $params = [];
        $params['flow_json'] = $json;
        if (isset($data['name'])) { 
            $params['name'] = $data['name'];
        }
        if (isset($data['started'])) {
          $params['started'] = $data['started'];
        }
        $flow->update($params);
    }
    public function flowData(Request $request, $flowId)
    {
        $flow = Flow::where('public_id', '=', $flowId)->firstOrFail();
        if (!$this->hasPermissions($request, $flow, 'manage_flows')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($flow->toArray());
    }
    public function listFlows(Request $request)
    {
        $all = $request->get("all");
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $flows = Flow::where('user_id', $user->id);
        if (!empty($request->get("category"))) {
            $category = $request->get("category");
            $flows->where('category', $category);
        }
        if ($all) {
          return $this->response->collection($flows->get(), new FlowTransformer);
        }

        MainHelper::addSearch($request, $flows, ['name']);
        return $this->response->paginator($flows->paginate($paginate), new FlowTransformer);
    }
    public function listTemplates(Request $request)
    {
        $templates = FlowTemplate::get();
        return $this->response->collection($templates, new FlowTemplateTransformer);
    }

    public function deleteFlow(Request $request, $flowId)
    {
        $data = $request->json()->all();
        $flow = Flow::findOrFail($flowId);
        if (!$this->hasPermissions($request, $flow, 'manage_flows')) {
            return $this->response->errorForbidden();
        }
        $flow->delete();
        return $this->response->noContent();
    }

}

