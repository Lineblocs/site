<?php

namespace App\Http\Controllers\Api\Fax;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Fax;
use \App\FaxTag;
use \App\Transformers\FaxTransformer;
use \DB;
use App\Helpers\MainHelper;



class FaxController extends ApiAuthController {
    public function faxData(Request $request, $faxId)
    {
        $fax = Fax::where('api_id', '=', $faxId)->firstOrFail();
        if (!$this->hasPermissions($request, $fax, 'manage_faxes')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($fax->toArray());
    }
    public function listFaxes(Request $request)
    {
        DB::connection()->enableQueryLog();
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $faxs = Fax::where('workspace_id', $workspace->id);
        $faxs = Fax::select(DB::raw("faxes.*, calls.from AS call_from, calls.to AS call_to, calls.status AS call_status, calls.direction AS call_direction"));
        $faxs->leftJoin('calls', 'calls.id', '=', 'faxes.call_id');
        $faxs->where('faxes.workspace_id', '=', $workspace->id);
        MainHelper::addSearch($request, $faxs, ['from', 'to']);
        $response = $this->response->paginator($faxs->paginate($paginate), new FaxTransformer);
        return $response;
    }

    public function deleteFax(Request $request, $faxId)
    {
        $fax = Fax::findOrFail($faxId);
        if (!$this->hasPermissions($request, $fax, 'manage_faxes')) {
            return $this->response->errorForbidden();
        }
        if (!empty($fax->name)) {
          
              $path = implode(DIRECTORY_SEPARATOR, array(public_path('/faxes'), $fax->name));
              if (!unlink($path)) {
                throw new \Exception("could not delete fax file..");
              }
        }
        $fax->delete();
   }
     
}

