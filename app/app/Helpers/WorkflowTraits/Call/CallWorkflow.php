<?php

namespace App\Helpers\WorkflowTraits\Call;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Call;
use \App\Recording;
use \App\Transformers\CallTransformer;
use DateTime;
use DateInterval;
use DB;
use App\Helpers\MainHelper;


trait CallWorkflow {
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
        $call = Call::where('api_id', '=', $callId)->firstOrFail();
        if (!$this->hasPermissions($request, $call, 'manage__calls')) {
            return $this->response->errorForbidden();
        }
        $info = $call->toArray();
        $info['recordings'] = Recording::where('call_id', '=', $call->id)->get()->toArray();
        return $this->response->array($info);
    }
    public function listCalls(Request $request)
    {
        DB::connection()->enableQueryLog();
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $calls = Call::select(DB::raw("DISTINCT(calls.id), calls.*, calls.from AS call_from, calls.to AS call_to, calls.status AS call_status, calls.direction AS call_direction, (SELECT GROUP_CONCAT(call_tags.tag) FROM call_tags WHERE call_tags.call_id = calls.id) AS tags"));
        $calls->leftJoin('call_tags', 'call_tags.call_id', '=', 'calls.id');
        $calls->where('calls.user_id', '=', $user->id);
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
