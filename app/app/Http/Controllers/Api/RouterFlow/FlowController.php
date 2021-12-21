<?php 
namespace App\Http\Controllers\Api\RouterFlow;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\RouterFlow;
use \App\RouterFlowTemplate;
use \App\MacroFunction;
use \App\Transformers\RouterFlowTransformer;
use \App\Transformers\RouterFlowTemplateTransformer;
use \App\Helpers\MainHelper;



class FlowController extends ApiAuthController {
    public function saveFlow(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $category = 'pstn';
        $json = $data['flow_json'];

        if (!empty($data['category'])) {
            $category = $data['category'];
        }
        if ($data['template_id']) {
          $flow = RouterFlow::createFromTemplate( $data['name'], $user,RouterFlowTemplate::findOrFail($data['template_id'] ), $category);
        } else {
          $flow = RouterFlow::create([
              'admin_id' => $user->id,
              'name' => $data['name'],
              'flow_json' => $json,
              'category' => $category
          ]);
        }

        return $this->response->array($flow->toArray())->withHeader('X-RouterFlow-ID', $flow->id);
    }
    public function updateFlow(Request $request, $flowId)
    {
        $data = $request->json()->all();
        $flow = RouterFlow::where('id', '=', $flowId)->firstOrFail();
        if (isset($data['template_id'])) {
          $template = RouterFlowTemplate::findOrFail($data['template_id']);
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
        $flow = RouterFlow::where('id', $flowId)->firstOrFail();
        return $this->response->array($flow->toArray());
    }
    public function listFlows(Request $request)
    {
    }
    public function listTemplates(Request $request)
    {
        $templates = RouterFlowTemplate::get();
        return $this->response->collection($templates, new RouterFlowTemplateTransformer);
    }

    public function deleteFlow(Request $request, $flowId)
    {
        return $this->response->noContent();
    }

}

