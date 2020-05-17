<?php namespace App\Http\Controllers\Api\BYO\DID;

use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYODIDNumber; 
use \App\BYODIDNumberRoute; 
use \App\Transformers\BYODIDNumberTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use Mail;
use Config;



class BYODIDNumberController extends BYOController {
    public function numberData(Request $request, $didId)
    {
        $number = BYODIDNumber::select(DB::raw("byo_did_numbers.*, flows.id AS flow_id, flows.public_id AS flow_public_id"));
        $number->leftJoin('flows', 'flows.id', '=', 'byo_did_numbers.flow_id');
        $number = $number->where('byo_did_numbers.public_id', '=', $didId)->firstOrFail();

        if (!$this->hasPermissions($request, $number, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }

        $array = $number->toArray();
        return $this->response->array($array);
    }
    public function listNumbers(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
        $workspace = $workspace = $this->getWorkspace($request); 
        $dids = BYODIDNumber::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $dids, ['number']);
        return $this->response->paginator($dids->paginate($paginate), new BYODIDNumberTransformer);
    }

    public function deleteNumber(Request $request, $didId)
    {
        $did = BYODIDNumber::findOrFail($didId);
        if (!$this->hasPermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }
        $did->delete();
   }
    public function updateNumber(Request $request, $didId)
    {
        $data = $request->json()->all();
        $did = BYODIDNumber::where('public_id', $didId)->firstOrFail();
        if (!$this->hasPermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorForbidden();
        }
        $did->update($data);
   }
    public function saveNumber(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_byo_did_number')) {
          return $this->errorPerformingAction();
        }
        $did = BYODIDNumber::create( array_merge($data, [
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
      ]));
        return $this->response->noContent()->withHeader('X-DIDNumber-ID', $did->id);
    }

}

