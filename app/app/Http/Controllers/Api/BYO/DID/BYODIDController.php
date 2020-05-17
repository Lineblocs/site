<?php

namespace App\Http\Controllers\Api\BYO\DIDNumber;

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
use File;



class DIDNumberController extends BYOController {

     public static $acceptedFileFormats = array("csv");
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
        if (!$this->haspermissions($request, $did, 'manage_byo_did_numbers')) {
            return $this->response->errorforbidden();
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
        $did = BYODIDNumber::create( array_merge(array(
            "user_id" => $user->id, 
            "workspace_id" => $workspace->id
        ), $data ));
        return $this->response->noContent()->withHeader('X-DIDNumber-ID', $did->id);
    }
    public function importNumber(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_byo_numbers')) {
          return $this->errorPerformingAction();
        }
        $file = \Input::file("file");
        if (!$file->isValid()) {
        \Log::error(sprintf("file invalid"));
        return;
        }
        $size = $file->getSize();
        $extension = $file->guessExtension();
        \Log::info(sprintf("uploading file size: %d, format is %s", $size, $extension));
        if (!in_array($extension, self::$acceptedFileFormats)) {
          return FALSE;
        }
        $path = $file->getRealPath();
        //$contents = File::get($path);
        $row = 1;
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                //echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                $flowId = NULL;
                if (!empty( $data[ 1 ] )) {
                    $flowId = $data[1];
                }
                $params = array(
                    "flow_id" => $flowId,
                    "numbr" => $data[0]
                );
                $did = BYODIDNumber::create( array_merge(array(
                    "user_id" => $user->id, 
                    "workspace_id" => $workspace->id
                ), $params ));
                for ($c=0; $c < $num; $c++) {
                    //echo $data[$c] . "<br />\n";

                }
            }
            fclose($handle);
        }
        return $this->response->noContent();

    }

}

