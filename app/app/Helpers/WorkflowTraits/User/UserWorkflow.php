<?php

namespace App\Helpers\WorkflowTraits\User;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Flow;
use \App\FlowTemplate;
use \App\Transformers\FlowTransformer;
use \App\Transformers\FlowTemplateTransformer;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkspaceHelper;
use \App\Helpers\WorkflowTraits\User\UserWorkflow;
use App\WorkspaceUser;
use App\WorkspaceInvite;
use DB;
use Mail;
use Config;
use DateTime;



trait UserWorkflow {
    private function createUser($data, $workspace) {
        $user = $data['user'];
        //TODO send invite
        $newUser = MainHelper::createUserWithoutPaymentGateway($user, TRUE);
        return $newUser;
    }

    public function createInvite($workspaceUser) {
        $date = new DateTime(date("Y-m-d"));
        $date->modify('+7 day');
        $hash = MainHelper::createJoinHash();
        $item = WorkspaceInvite::create([
            'workspace_id' => $workspaceUser->workspace_id,
            'workspace_user_id' => $workspaceUser->id,
            'expires_on' => $date,
            'valid' => TRUE,
            'hash' => $hash
        ]);
        return $item;
    }
    private function sendInvite($invite, $newUser, $workspaceUser, $workspace) {
        $mail = Config::get("mail");
        $mailData = compact('newUser', 'workspace');
        $invite = $this->createInvite($workspaceUser);
        //$hash = $workspaceUser->createJoinHash();
        $link = MainHelper::createPortalLink("/#/join-workspace/". $invite->hash);
        $mailData['link'] =  $link;
          Mail::send('emails.invited_to_workspace', $mailData, function ($message) use ($newUser, $mail, $workspace) {
            $message->to($newUser->email);
            $message->subject("You have been invited to workspace " . $workspace->name);
            $from = $mail['from'];
            $message->from($from['address'], $from['name']);
        });

    }
    public function addUser(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        //check if they exist already
        $reqUser = User::where('email', '=', $data['user']['email'])->first();
        if (!$reqUser) {
            $reqUser = $this->createUser($data, $workspace);
        }
        $attrs = $data['roles'];
        $attrs['user_id'] = $reqUser->id;
        $attrs['workspace_id'] = $workspace->id;
        $resource = WorkspaceUser::create($attrs);
        $invite = $this->createInvite($resource);
        $this->sendInvite($invite, $reqUser,$resource, $workspace);
        return $this->response->array($resource->toArray())->withHeader('X-WorkspaceUser-ID', $resource->public_id);
    }
    public function updateUser(Request $request, $userId)
    {
        $data = $request->json()->all();
        $workspaceUser = WorkspaceUser::where('public_id', '=', $userId)->firstOrFail();
        if (!$this->hasPermissions($request, $workspaceUser, 'manage_users')) {
            return $this->response->errorForbidden();
        }
        if (!empty($data['roles'])) {
                $attrs = $data['roles'];
                $workspaceUser->update($attrs);
        }
        if (!empty($data['assign'])) {
                $attrs = $data['assign'];
                $workspaceUser->update($attrs);
        }

    }
    public function userData(Request $request, $userId)
    {
        $workspace = $this->getWorkspace($request);
        $workspaceUser =  WorkspaceUser::select(DB::raw("workspaces_users.*, users.email, users.first_name, users.last_name"));
        $workspaceUser->leftJoin('workspaces', 'workspaces.id', '=', 'workspaces_users.workspace_id');
        $workspaceUser->leftJoin('users', 'users.id', '=', 'workspaces_users.user_id');
        $workspaceUser->where('workspaces_users.public_id', '=', $userId);
        $workspaceUser = $workspaceUser->firstOrFail();
        if (!$this->hasPermissions($request, $workspaceUser, 'manage_users')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($workspaceUser->toArray());
    }
    public function listUsers(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $workspaces =  WorkspaceUser::select(DB::raw("workspaces_users.*, users.email, users.first_name, users.last_name"));
        $workspaces->leftJoin('workspaces', 'workspaces.id', '=', 'workspaces_users.workspace_id');
        $workspaces->leftJoin('users', 'users.id', '=', 'workspaces_users.user_id');
        $workspaces->where('workspaces_users.workspace_id', '=', $workspace->id);
        return $this->response->array($workspaces->get()->toArray());
    }
    public function deleteUser(Request $request, $userId)
    {
        $data = $request->json()->all();
        $user = WorkspaceUser::where('public_id', '=', $userId)->firstOrFail();
        if (!$this->hasPermissions($request, $user, 'manage_users')) {
            return $this->response->errorForbidden();
        }
        $user->delete();
        return $this->response->noContent();
    }

    public function resendInvite(Request $request, $userId)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $resource= WorkspaceUser::where('public_id', $userId)->firstOrFail();
        if (!WorkspaceHelper::canPerformAction($workspace, $user, 'manage_users')) {
            return $this->response->errorForbidden();
        }
        $reqUser = User::findOrFail($resource->user_id);

        WorkspaceInvite::where("workspace_user_id", $resource->id)->update(['valid' => FALSE]);
        $invite = $this->createInvite($resource);
        //invalidate current invite if needed
        $this->sendInvite($invite, $reqUser,$resource, $workspace);
        return $this->response->noContent();
    }
}
