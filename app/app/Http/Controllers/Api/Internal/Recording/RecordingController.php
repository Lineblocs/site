<?php

namespace App\Http\Controllers\Api\Internal\Recording;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Recording;
use \App\RecordingTag;
use \App\Call;
use \App\Transformers\RecordingTransformer;
use \DB;
use App\Helpers\MainHelper;

use \Config;
use \Storage;




class RecordingController extends ApiAuthController {
    public function createRecording(Request $request)
    {
      $data = $request->json()->all();
      $user = User::findOrFail($data['user_id']);
      $call = Call::findOrFail($data['call_id']);
      $tags = [];
      if (!empty($tags)) {
          $tags = $data['tags'];
      }
      

      $recording = Recording::create([
        'uri' => '',
        'status' => 'started',
        'user_id' => $user->id,
        'call_id' => $call->id,
        'workspace_id' => $data['workspace_id']
      ]);
      foreach ($tags as $tag) {
        RecordingTag::create([
          'recording_id' => $recording->id,
          'tag' => $ag
        ]);
      }
  
      return $this->response->array($recording->toArray())->withHeader("X-Recording-ID", $recording->id);
    }
    public function updateRecording(Request $request) 
    {
      $data = $request->all();
      $recording = Recording::findOrFail($data['recording_id']);
      $params = [];
      if ($request->hasFile('file')) {
            $name = $recording->api_id.'.'.$request->file('file')->getClientOriginalExtension();
            $params['name'] = $name;
            $s3 = \Storage::disk('s3');
            $file = $request->file;
            $filePath = '/recordings/' . $name;
            $s3->put($filePath, file_get_contents($file), 'public');
            /*
            $request->file('file')->move(
              public_path('/fs/recordings'),
              $name
            );
            */
            $config = \Config::get("s3fs");
            $http = sprintf("%s/recordings/%s", $config['url'], $name);
            $size =$file->getSize();
            //$params['uri'] = $http;
            $params['size'] = $size;
      }
      $params['status'] = $data['status'];
      $recording->update( $params );
    }
     
}

