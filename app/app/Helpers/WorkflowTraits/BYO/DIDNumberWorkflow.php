<?php

namespace App\Helpers\WorkflowTraits\BYO;
use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYODIDNumber; 
use \App\BYODIDNumberRoute; 
use \App\Flow;
use \App\Transformers\BYODIDNumberTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use Mail;
use Config;
use File;



trait DIDNumberWorkflow {
     public static $acceptedFileFormats = array("csv", "txt");
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
        $workspace = $workspace = $this->getWorkspace($request); 
        $all = $request->get("all");
        if ($all) {
          $dids = BYODIDNumber::where('workspace_id', $workspace->id);
          MainHelper::addSearch($request, $dids, ['number']);
          return $this->response->collection($dids->get(), new BYODIDNumberTransformer);

        }
        $paginate = $this->getPaginate( $request );
        $dids = BYODIDNumber::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $dids, ['number']);
        return $this->response->paginator($dids->paginate($paginate), new BYODIDNumberTransformer);
    }

    public function deleteNumber(Request $request, $didId)
    {
        $did = BYODIDNumber::where('public_id', $didId)->firstOrFail();
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
        $data = $request->json()->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_byo_did_number')) {
          return $this->errorPerformingAction();
        }
        $params = [];
        $params['number'] = $data['number'];
        if (!empty($data['flow_id'])) {
          $params['flow_id'] = MainHelper::resolveAppId(new Flow, $data['flow_id']);
        }
        \Log::info("attaching flow id: " . $params['flow_id']);
        $did = BYODIDNumber::create( array_merge($params, [
          'user_id' => $user->id,
          'workspace_id' => $workspace->id,
      ]));
        return $this->response->noContent()->withHeader('X-DIDNumber-ID', $did->public_id);
    }
    public function importNumbers(Request $request)
    {
        \Log::info("importNumbers called..");
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_byo_did_numbers')) {
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
          return $this->response->errorInternal("File format not accepted..");
        }
        $path = $file->getRealPath();
        //$contents = File::get($path);
        $row = 0;
        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                //echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                if ($row == 1) {
                  continue;
                }
                $params = [];
                $params['number'] = $data[0];
                if (!empty($data[1])) {
                  $params['flow_id'] = $data[1];
                }
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
