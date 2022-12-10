<?php

namespace App\Http\Controllers\Api\Macro;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\MacroFunction;
use \App\MacroTemplate;
use \App\Transformers\MacroFunctionTransformer;
use \App\Transformers\MacroTemplateTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;



class MacroController extends ApiAuthController {

    private function updateWorkspaceContainer($workspace) {
          $svc = "lineblocs-k8s-user";
          $params = array(
              'workspace' => $workspace->name,
          );
          $result = WebSvcHelper::post($svc, '/updateContainer', $params);
          return $result;
    }

    public function saveFunction(Request $request)
    {
        $data = $request->only('title', 'code');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_function')) {
          return $this->errorPerformingAction();
        }
        $existing = MacroFunction::where('title', $data['title'])->where('workspace_id', $workspace->id)->first();
        if ($existing) {
            return $this->errorInternal( $request, 'function already exists..');
        }
        $result = MainHelper::compileTypescript($data['code'], $output, $return);
        if (!$result) {
            $send = [
                'success' => false,
                'info' => $result
            ];
            return $this->response->array($send);
          }

        $compiled = implode("\n", $output);
        $function = MacroFunction::create(array_merge($data, [
              'title' => $data['title'],
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'compiled_code' => $compiled
          ]));

        if ( !$this->updateWorkspaceContainer($workspace)  ) {
            $send = [
                'success' => false,
                'info' => 'could not update container'
            ];
            return $this->response->array($send);
        }
        $send = [
                'success' => TRUE,
                'function' => $function->toArray()
            ];
        return $this->response->array($send)->withHeader('X-Function-ID', $function->public_id);
    }
    public function updateFunction(Request $request, $functionId)
    {
        $data = $request->all();
        $function = MacroFunction::where('public_id', '=', $functionId)->firstOrFail();
        if (!$this->hasPermissions($request, $function, 'manage_functions')) {
            return $this->response->errorForbidden();
        }
        MainHelper::compileTypescript($data['code'], $output, $return);
        if ($return != 0) {
            return $this->errorInternal( $request, 'could not compile code. errors: ' . json_encode($output));
          }
        $compiled = implode("\n", $output);
        $data['compiled_code'] = $compiled;
        $function->update( $data );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);

        if ( !$this->updateWorkspaceContainer($workspace)  ) {
            return $this->errorInternal( $request, 'could not update workspace');
        }
        return $this->response->noContent();
    }
    public function deleteFunction(Request $request, $functionId)
    {
        $data = $request->all();
        $function = MacroFunction::where('public_id', '=', $functionId)->firstOrFail();
        if (!$this->hasPermissions($request, $function, 'manage_functions')) {
            return $this->response->errorForbidden();
        }
        $user = $this->getUser($request);
        $function->delete();

        if ( !$this->updateWorkspaceContainer($workspace)  ) {
            return $this->errorInternal( $request, 'could not update workspace');
        }
        return $this->response->noContent();
  }


    public function functionData(Request $request, $functionId)
    {
        $function = MacroFunction::where('public_id', '=', $functionId)->firstOrFail();
        if (!$this->hasPermissions($request, $function, 'manage_functions')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($function->toArray());
    }
    public function listFunctions(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $functions = MacroFunction::where('workspace_id', $workspace->id)->get();
        return $this->response->collection($functions, new MacroFunctionTransformer);

    }


     public function saveTemplate(Request $request)
    {
        $data = $request->only('title', 'code');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $template = MacroTemplate::create(array_merge($data, [
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
          ]));
        return $this->response->array($template->toArray())->withHeader('X-Template-ID', $template->public_id);
    }
    public function updateTemplate(Request $request, $templateId)
    {
        $data = $request->all();
        $template = MacroTemplate::where('public_id', '=', $templateId)->firstOrFail();
        $data = $request->only('title', 'code');
        $template->update( $data );
        $user = $this->getUser($request);
        return $this->response->noContent();
    }
    public function deleteTemplate(Request $request, $templateId)
    {
        $data = $request->all();
        $template = MacroTemplate::where('public_id', '=', $templateId)->firstOrFail();
        $user = $this->getUser($request);
        $template->delete();
            return $this->errorInternal( $request );
  }


    public function templateData(Request $request, $templateId)
    {
        $template = MacroTemplate::where('public_id', '=', $templateId)->firstOrFail();
        return $this->response->array($template->toArray());
    }
    public function listTemplates(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $templates = MacroTemplate::all();
        return $this->response->collection($templates, new MacroTemplateTransformer);
    }


}

