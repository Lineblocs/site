<?php

namespace App\Http\Controllers\Api\Recording;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Recording;
use \App\RecordingTag;
use \App\Transformers\RecordingTransformer;
use \DB;
use App\Helpers\MainHelper;



class RecordingController extends ApiAuthController {
    public function recordingData(Request $request, $recordingId)
    {
        $recording = Recording::where('api_id', '=', $recordingId)->firstOrFail();
        if (!$this->hasPermissions($request, $recording, 'manage_recordings')) {
            return $this->response->errorForbidden();
        }
        return $this->response->array($recording->toArray());
    }
    public function listRecordings(Request $request)
    {
        DB::connection()->enableQueryLog();
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $recordings = Recording::select(DB::raw("DISTINCT(recordings.id), recordings.*, calls.from AS call_from, calls.to AS call_to, calls.status AS call_status, calls.direction AS call_direction, (SELECT GROUP_CONCAT(recording_tags.tag) FROM recording_tags WHERE recording_tags.recording_id = recordings.id) AS tags"));

        $recordings->leftJoin('calls', 'calls.id', '=', 'recordings.call_id');
        $recordings->leftJoin('recording_tags', 'recording_tags.recording_id', '=', 'recordings.id');
        $recordings->where('recordings.user_id', '=', $user->id);
        $search = $request->get("tags");
        if ( $search ) {
           \Log::info("tags are: " . $search);
           $splitted = explode(",", $search);
          $count = count($splitted);
            foreach ($splitted as $tag) {
              //$recordings->whereRaw("FIND_IN_SET(\"$tag\", \"1000,1001,voicemail\") > 0");
              //$recordings->whereRaw("FIND_IN_SET(\"$tag\", tags) > 0");
              $recordings->whereRaw("FIND_IN_SET(\"$tag\", (SELECT GROUP_CONCAT(recording_tags.tag) FROM recording_tags WHERE recording_tags.recording_id = recordings.id)) > 0");
            }
        }
        MainHelper::addSearch($request, $recordings, ['from', 'to', 'direction']);
        \Log::info("query: " . $recordings->toSql());
        $results = $recordings->paginate($paginate);

        $response = $this->response->paginator($results, new RecordingTransformer);
        return $response;
    }

    public function deleteRecording(Request $request, $recordingId)
    {
        $recording = Recording::findOrFail($recordingId);
        if (!$this->hasPermissions($request, $recording, 'manage_recordings')) {
            return $this->response->errorForbidden();
        }
        if (!empty($recording->name)) {
          
              $path = implode(DIRECTORY_SEPARATOR, array(public_path('/recordings'), $recording->name));
              if (!unlink($path)) {
                throw new \Exception("could not delete recording file..");
              }
        }
        $recording->delete();
   }
  public function addRecordingTag(Request $request, $recordingId)
    {
        $recording = Recording::findOrFail($recordingId);
        $data = $request->json()->all();
        if (!$this->hasPermissions($request, $recording, 'manage_recordings')) {
          return $this->response->errorForbidden();
        }
        RecordingTag::create(array_merge([
          'tag' => $data['tag']
        ], ['recording_id' => $recordingId]));
        return $this->response->noContent();
    }
    public function removeRecordingTag(Request $request, $recordingId, $tagName)
    {
        $recording = Recording::findOrFail($recordingId);
        $data = $request->json()->all();
        if (!$this->hasPermissions($request, $recording, 'manage_recordings')) {
          return $this->response->errorForbidden();
        }
        DB::table("recording_tags")->where('tag', '=', $tagName)->where('recording_id', $recordingId)->delete();
        return $this->response->noContent();
    }


     
}

