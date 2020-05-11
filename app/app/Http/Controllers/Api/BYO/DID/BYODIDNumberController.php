<?php

namespace App\Http\Controllers\Api\BYO\DID;

use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYODIDNumber; 
use \App\BYODIDNumberRoute; 
use \App\Transformers\DIDNumberTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use Mail;
use Config;



class BYODIDNumberController extends BYOController {
    public function didData(Request $request, $didId)
    {
        $did = BYODIDNumber::where('public_id', '=', $didId)->firstOrFail();
        if (!$this->hasPermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }

        return $this->response->array($did);
    }
    public function listDIDNumbers(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
        $workspace = $workspace = $this->getWorkspace($request); 
        $dids = BYODIDNumber::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $dids, ['number']);
        return $this->response->paginator($dids->paginate($paginate), new DIDNumberTransformer);
    }

    public function deleteDIDNumber(Request $request, $didId)
    {
        $did = BYODIDNumber::findOrFail($didId);
        if (!$this->hasPermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }
        $did->delete();
   }
    public function updateDIDNumber(Request $request, $didId)
    {
        $data = $request->json()->all();
        $did = BYODIDNumber::where('public_id', $didId)->firstOrFail();
        if (!$this->hasPermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }
        $did->update($data);
   }
    public function saveDIDNumber(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_byo_did_number')) {
          return $this->errorPerformingAction();
        }
        $did = BYODIDNumber::create( $data );
        return $this->response->noContent()->withHeader('X-DIDNumber-ID', $did->id);
    }

}

