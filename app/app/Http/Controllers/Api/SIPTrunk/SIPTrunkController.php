<?php

namespace App\Http\Controllers\Api\Trunk;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SIPTrunk;
use \App\Transformers\TrunkTransformer;
use \App\NumberService\SIPConfigService;
use \App\Helpers\PBXServerHelper;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use \DB;
use Mail;
use Config;


class SIPTrunkController extends ApiAuthController {
    public function saveTrunk(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        return $this->response->array($trunk->toArray())->withHeader('X-Trunk-ID', $trunk->public_id);
    }
    public function updateTrunk(Request $request, $trunkId)
    {
        $data = $request->json()->all();
        $trunk = SIPTrunk::where('public_id', '=', $trunkId)->firstOrFail();
        $trunk->update($params);
    }
    public function trunkData(Request $request, $trunkId)
    {
        $trunk = SIPTrunk::where('public_id', '=', $trunkId)->firstOrFail();
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($trunk->toArray());
    }
    public function listTrunks(Request $request)
    {
        $all = $request->get("all");
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $trunks = SIPTrunk::where('workspace_id', $workspace->id);
        if ($all) {
          return $this->response->collection($trunks->get(), new TrunkTransformer);
        }

        MainHelper::addSearch($request, $trunks, ['name']);
        return $this->response->paginator($trunks->paginate($paginate), new TrunkTransformer);
    }

    public function deleteTrunk(Request $request, $trunkId)
    {
        $data = $request->json()->all();
        $trunk = SIPTrunk::findOrFail($trunkId);
        if (!$this->hasPermissions($request, $trunk, 'manage_trunks')) {
            return $this->response->errorForbidden();
        }
        $trunk->delete();
        return $this->response->noContent();
    }
}

