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
use \App\ThirdParty\SIPConfigService;
use \App\Helpers\PBXServerHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;



class MacroController extends ApiAuthController {
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
          return $this->response->errorInternal('function already exists..');
        }
        MainHelper::compileTypescript($data['code'], $output, $return);
        if ($return != 0) {
          return $this->response->errorInternal('could not compile code. errors: ' . json_encode($output));
          }

        $compiled = implode("\n", $output);
        $function = MacroFunction::create(array_merge($data, [
              'title' => $data['title'],
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'compiled_code' => $compiled
          ]));
        return $this->response->array($function->toArray())->withHeader('X-Function-ID', $function->public_id);
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
          return $this->response->errorInternal('could not compile code');
          }
        $compiled = implode("\n", $output);
        $data['compiled_code'] = $compiled;
        $function->update( $data );
        $user = $this->getUser($request);
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
        return $this->response->errorInternal();
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
        return $this->response->errorInternal();
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

