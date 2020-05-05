<?php

namespace App\Http\Controllers\Api\Internal\Fax;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Fax;
use \App\Call;
use \App\Transformers\RecordingTransformer;
use \DB;
use App\Helpers\MainHelper;
use \Config;



class FaxController extends ApiAuthController {
    public function createFax(Request $request)
    {
      $user = User::findOrFail($request->get('user_id'));
      $call = Call::findOrFail($request->get('call_id'));

      $params = [
        'uri' => '',
        'user_id' => $user->id,
        'call_id' => $call->id,
        'workspace_id' => $request->Get('workspace_id')
      ];
      $fax = Fax::create($params);
      $name = $fax->api_id.'.'.$request->file('file')->getClientOriginalExtension();
      $params['name'] = $name;
      $request->file('file')->move(
        public_path('/fs/faxes'),
        $name
      );
      $http = Config::get("app.url")."/faxes/".$name;
      $file = public_path('/fs/faxes').'/'.$name;
      $size = filesize($file);
      $params['uri'] = $http;
      $params['size'] = $size;
      $fax->update($params);
      return $this->response->array($fax->toArray())->withHeader("X-Fax-ID", $fax->id);
    }
}

