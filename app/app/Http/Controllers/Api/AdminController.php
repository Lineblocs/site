<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiAuthController;
use App\Transformers\WorkspaceTransformer;
use App\Workspace;
use Illuminate\Http\Request;

class AdminController extends ApiAuthController
{
    public function getWorkspaces(Request $request)
    {
        $isAdmin = $this->checkAdminAuth($request);
        if (!$isAdmin) {
            return $this->response->errorForbidden("incorrect admin token..");
        }
        $workspaces = Workspace::all();
        return $this->response->collection($workspaces, new WorkspaceTransformer);
    }

}
