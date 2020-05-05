<?php

namespace App\Http\Controllers\Api\PhoneGroup;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\PhoneGroup;
use \App\PhoneDefinition;
use \App\Transformers\PhoneGroupTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;



class PhoneGroupController extends ApiAuthController {
    public function phoneGroupData(Request $request, $phoneGroupId)
    {
        $phoneGroup = PhoneGroup::where('public_id', '=', $phoneGroupId)->firstOrFail();
        if (!$this->hasPermissions($request, $phoneGroup, 'manage_phonegroups')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($phoneGroup->toArray());
    }
    public function listPhoneGroups(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
      $workspace = $workspace = $this->getWorkspace($request); 
        $phoneGroups = PhoneGroup::where('workspace_id', $workspace->id);

        MainHelper::addSearch($request, $phoneGroups, ['name']);
        return $this->response->paginator($phoneGroups->paginate($paginate), new PhoneGroupTransformer);
    }

    public function deletePhoneGroup(Request $request, $phoneGroupId)
    {
        $phoneGroup = PhoneGroup::findOrFail($phoneGroupId);
        if (!$this->hasPermissions($request, $phoneGroup, 'manage_phonegroups')) {
            return $this->response->errorForbidden();
        }
        $phoneGroup->delete();
   }
    public function updatePhoneGroup(Request $request, $phoneGroupId)
    {
        $phoneGroup = PhoneGroup::where('public_id', $phoneGroupId)->firstOrFail();
        if (!$this->hasPermissions($request, $phoneGroup, 'manage_phonegroups')) {
            return $this->response->errorForbidden();
        }
        $phoneGroup->update($request->json()->all());
   }
    public function savePhoneGroup(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_phonegroup')) {
          return $this->errorPerformingAction();
        }
        $group = PhoneGroup::create([
              'user_id' => $user->id,
              'workspace_id' => $workspace->id,
              'number' => $data['number'],
              'name' => $data['name']
        ]);
      return $this->response->noContent()->withHeader('X-Group-ID', $group->id);
    }
}




