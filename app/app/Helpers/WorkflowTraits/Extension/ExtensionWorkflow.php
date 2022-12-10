<?php

namespace App\Helpers\WorkflowTraits\Extension;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Extension;
use \App\ExtensionTag;
use \App\Flow;
use \App\Transformers\ExtensionTransformer;
use App\NumberService\SIPConfigService;
use \App\Helpers\SIPRouterHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use \DB;
use Mail;
use Config;






trait ExtensionWorkflow {
    public function saveExtension(Request $request)
    {
        $data = $request->only('username', 'secret', 'caller_id', 'flow_id', 'tags');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $info = $workspace->getPlanInfo();

        if (MainHelper::checkLimit($workspace, $user, "extensions")) {
          return $this->response->error('Cannot create extension because you have reached the extensions limit on your plan', 500);
        }
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_extension')) {
          return $this->errorPerformingAction();

        }
        if (empty($data['flow_id'])) {
            $flow = Flow::create([
              'name' => 'Flow for ext ' . $data['username'],
              'user_id' => $user->id,
              'flow_json' => null,
              'started' => false,
              'workspace_id' => $workspace->id,
              'user_id' => $user->id,
              'category' => 'extension'
            ]);
            $extension = Extension::create([
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'flow_id' => $flow->id,
              'username' => $data['username'],
              'secret' => $data['secret'],
              'caller_id' => $data['caller_id'],
          ]);
        } else {
          $extension = Extension::create([
              'user_id' => $user->id,
              'flow_id' => $data['flow_id'],
              'workspace_id' => $workspace->id,
              'username' => $data['username'],
              'secret' => $data['secret'],
              'caller_id' => $data['caller_id'],
          ]);
        }
        $tags = $data['tags'];
        ExtensionTag::updateModelTags($tags, $extension->id);


        if (empty($data['flow_id'])) {
            $flow = Flow::create([
              'name' => 'Flow for ext ' . $extension->username,
              'user_id' => $user->id,
              'flow_json' => null,
              'started' => false,
              'workspace_id' => $workspace->id,
              'user_id' => $user->id,
              'category' => 'extension'
            ]);
            $extension->update(['flow_id' => $flow->id]);
        }

          
        $extensions = Extension::where('user_id', '=', $user->id)->get()->toArray();

    

        //$status = SIPConfigService::provision($user->id, $user->username, $data['username'], $data['secret']);
        $status = SIPRouterHelper::provision($user, $workspace, $extensions);
        if ($status) {
            $mail = Config::get("mail");
            $data = compact('extension', 'workspace');
            Mail::send('emails.extension_created', $data, function ($message) use ($user, $mail) {
                $message->to($user->email);
                $message->subject("Extension Created");
                $from = $mail['from'];
                $message->from($from['address'], $from['name']);
            });
            return $this->response->array($extension->toArray())->withHeader('X-Extension-ID', $extension->public_id);
        }
        return $this->errorInternal($request, 'Provision extension error..');
    }
    public function updateExtension(Request $request, $extensionId)
    {
        $workspace = $this->getWorkspace($request);
        \Log::info("in updateExtension");
        $extension = Extension::where('public_id', '=', $extensionId)->firstOrFail();
        if (!$this->hasPermissions($request, $extension, 'manage_extensions')) {
            return $this->response->errorForbidden();
        }

        $data = $request->only('username', 'secret', 'caller_id', 'flow_id', 'tags');
        $tags = $data['tags'];
        unset($data['tags']);
        $extension->update( $data );
        ExtensionTag::updateModelTags($tags, $extension->id);
        $user = $this->getUser($request);
        $extensions = Extension::where('user_id', '=', $user->id)->get()->toArray();
        //$status = SIPConfigService::provision($user->id, $user->username, $data['username'], $data['secret']);
        \Log::info("updateExtension provision called");
        $status = SIPRouterHelper::provision($user, $workspace, $extensions);
        \Log::info("updateExtension provision ended");

        if ($status) {
            return $this->response->noContent();
        }
        return $this->errorInternal($request, 'Provision extension error..');
    }
    public function deleteExtension(Request $request, $extensionId)
    {
        $data = $request->all();
        $workspace = $this->getWorkspace($request);
        $extension = Extension::where('public_id', '=', $extensionId)->firstOrFail();
        if (!$this->hasPermissions($request, $extension, 'manage_extensions')) {
            return $this->response->errorForbidden();
        }
        $user = $this->getUser($request);
        $extension->delete();
        $extensions = Extension::where('user_id', '=', $user->id)->get()->toArray();
        //$status = SIPConfigService::provision($user->id, $user->username, $data['username'], $data['secret']);
        $status = SIPRouterHelper::provision($user, $workspace, $extensions);
        if ($status) {
            return $this->response->array($extension->toArray())->withHeader('X-Extension-ID', $extension->id);
        }
        return $this->errorInternal($request, 'Provision extension error..');
  }


    public function extensionData(Request $request, $extensionId)
    {
        $extension =  Extension::select(DB::raw("extensions.*, flows.id AS flow_id, flows.public_id AS flow_public_id"));
        $extension->leftJoin('flows', 'flows.id', '=', 'extensions.flow_id');
        $extension = $extension->where('extensions.public_id', '=', $extensionId)->firstOrFail();

        if (!$this->hasPermissions($request, $extension, 'manage_extensions')) {
            return $this->response->errorForbidden();
        }
        $array = $extension->toArray();
        $array['tags'] = array_map(function($item) {
          return $item['tag'];
        }, ExtensionTag::where('extension_id', $extension->id)->get()->toArray());


        return $this->response->array($array);
    }
    public function listExtensions(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $all = $request->get("all");
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $extensions = Extension::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $extensions, ['username']);
        if (!empty($all)) {
            return $this->response->collection($extensions->get(), new ExtensionTransformer);
        }
        return $this->response->paginator($extensions->paginate($paginate), new ExtensionTransformer);
    }
}
