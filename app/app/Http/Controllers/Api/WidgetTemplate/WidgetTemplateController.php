<?php 
namespace App\Http\Controllers\Api\WidgetTemplate;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\WidgetTemplate;
use \App\WidgetTemplateTag;
use \App\Transformers\WidgetTemplateTransformer;
use \App\Helpers\MainHelper;



class WidgetTemplateController extends ApiAuthController {
    public function saveWidget(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace( $request );
        $data = $request->json()->all();
        $template = WidgetTemplate::create([
          'title' => $data['title'],
          'data' => json_encode($data['data']),
          'user_id' => $user->id,
          'workspace_id' => $workspace->id
        ]);
        foreach($data['tags'] as $tag) {
          WidgetTemplateTag::create([
            'title' => $tag,
            'template_id' => $template->id
          ]);
        }
        return $this->response->noContent();
    }
    public function listWidgets(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace( $request );
        $templates = WidgetTemplate::where('workspace_id', $workspace->id)->get();
        return $this->response->collection($templates, new WidgetTemplateTransformer);
    }

}

