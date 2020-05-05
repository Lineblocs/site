<?php 
namespace App\Http\Controllers\Api\WorkspaceUser;
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
use App\WorkspaceUser;
use DB;
use Mail;
use Config;

class WorkspaceUserController extends ApiAuthController {
    private function createUser($data, $workspace) {
        $user = $data['user'];
        //TODO send invite
        $newUser = MainHelper::createUserWithoutStripe($user, TRUE);
        return $newUser;
    }
    private function sendInvite($newUser, $workspaceUser, $workspace) {
        $mail = Config::get("mail");
        $mailData = compact('newUser', 'workspace');
        $hash = $workspaceUser->createJoinHash();
        $link = Config::get("app.portal_url")."/#/join-workspace/". $hash;
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
        $this->sendInvite($reqUser,$resource, $workspace);
        return $this->response->array($resource->toArray())->withHeader('X-WorkspaceUser-ID', $resource->public_id);
    }
    public function updateUser(Request $request, $userId)
    {
        $data = $request->json()->all();
        $workspaceUser = WorkspaceUser::where('public_id', '=', $userId)->firstOrFail();
        if (!$this->hasPermissions($request, $workspaceUser, 'manage_users')) {
            return $this->response->errorForbidden();
        }
        $attrs = $data['roles'];
        $workspaceUser->update($attrs);
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

}

