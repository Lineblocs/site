<?php

namespace App\Helpers\WorkflowTraits\Call;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Recording;
use \App\Helpers\MainHelper;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;
use DB;


trait CallWorkflow {
    public function createAISummary(Call $call)
    {
        if (!$call->relationLoaded('speakers')) {
            $call->load('speakers');
        }
        if (!$call->relationLoaded('chapters')) {
            $call->load('chapters');
        }
        if (!$call->relationLoaded('actionItems')) {
            $call->load('actionItems');
        }

        return [
            'speakers' => $call->speakers->map(function ($speaker) {
                return [
                    'id' => $speaker->id,
                    'speaker_name' => $speaker->speaker_name,
                    'start_talk_time' => (float) $speaker->start_talk_time,
                    'end_talk_time' => (float) $speaker->end_talk_time,
                ];
            })->values()->toArray(),
            'chapters' => $call->chapters->map(function ($chapter) {
                return [
                    'id' => $chapter->id,
                    'title' => $chapter->title,
                    'summary' => $chapter->summary,
                    'start_time' => (float) $chapter->start_time,
                ];
            })->values()->toArray(),
            'action_items' => $call->actionItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'speaker_id' => $item->speaker_id,
                    'action_item' => $item->action_item,
                    'status' => $item->status,
                    'priority' => $item->priority,
                ];
            })->values()->toArray(),
        ];
    }
    private function getCallData($direction, $start, $end)
    {
      $user = $this->getUser($request);
      $calls = Call::where('created_at', '>=', $start)
                           ->where('created_at', '<=', $end)
                            ->where('user_id', '=', $user->id);
      return $calls->count();
    }
    public function callData(Request $request, $callId)
    {
        $call = Call::with(['speakers', 'chapters', 'actionItems'])->where('api_id', '=', $callId)->firstOrFail();
        if (!$this->hasPermissions($request, $call, 'manage_calls')) {
            return $this->response->errorForbidden();
        }

        $info = $call->toArray();
        $info['recordings'] = Recording::where('call_id', '=', $call->id)->get()->toArray();
        $info['ai_summary'] = $this->createAISummary($call);

        return $this->response->array($info);
    }

    public function listCalls(Request $request)
    {
        DB::connection()->enableQueryLog();
        $extension = $request->get("extension");
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $calls = Call::select(DB::raw("DISTINCT(calls.id), calls.*, calls.from AS call_from, calls.to AS call_to, calls.status AS call_status, calls.direction AS call_direction, (SELECT GROUP_CONCAT(call_tags.tag) FROM call_tags WHERE call_tags.call_id = calls.id) AS tags"));
        $calls->leftJoin('call_tags', 'call_tags.call_id', '=', 'calls.id');
        //$calls->where('calls.user_id', '=', $user->id);
        $calls->where('calls.workspace_id', '=', $workspace->id);

        if (!empty($extension)) {
            $calls = $calls->where('from', $extension)
            ->orWhere('to', $extension);
        }

        $calls->orderBy('calls.created_at', 'DESC');
        $search = $request->get("tags");
        if ( $search ) {
           \Log::info("tags are: " . $search);
           $splitted = explode(",", $search);
          $count = count($splitted);
            foreach ($splitted as $tag) {
              //$calls->whereRaw("FIND_IN_SET(\"$tag\", \"1000,1001,voicemail\") > 0");
              //$calls->whereRaw("FIND_IN_SET(\"$tag\", tags) > 0");
              $calls->whereRaw("FIND_IN_SET(\"$tag\", (SELECT GROUP_CONCAT(call_tags.tag) FROM call_tags WHERE call_tags.call_id = calls.id)) > 0");
            }
        }
        MainHelper::addSearch($request, $calls, ['from', 'to', 'status', 'direction']);
        \Log::info("query: " . $calls->toSql());
        $results = $calls;

        return $this->sendPaginationResults($request, $results, $paginate, new CallTransformer);
    }

    public function updateCall(Request $request, $callId)
    {
        $call = Call::where('api_id', $callId)->firstOrFail();
        $data = $request->json()->all();
        $call->update( $data );
        return $this->response->noContent();
    }
    
}
