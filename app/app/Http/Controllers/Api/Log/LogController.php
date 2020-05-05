<?php

namespace App\Http\Controllers\Api\Log;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\DebuggerLog;
use \App\Recording;
use \App\Transformers\DebuggerLogTransformer;
use DateTime;
use DateInterval;
use App\Helpers\MainHelper;



class LogController extends ApiAuthController {
    private function getLogData($user, $direction, $start, $end)
    {
      $logs = DebuggerLog::where('created_at', '>=', $start)
                           ->where('created_at', '<=', $end)
                            ->where('user_id', '=', $user->id);
      return $logs->count();
    }
    public function logData(Request $request, $logId)
    {
        $log = DebuggerLog::select(array('debugger_logs.*', 'flows.name AS flow_name'));
        $log->leftJoin('flows', 'flows.id', '=', 'debugger_logs.flow_id');
        $log->where('api_id', '=', $logId);
        $log = $log->firstOrFail();
        if (!$this->hasPermissions($request, $log, 'manage_logs')) {
            return $this->response->errorForbidden();
        }
        $info = $log->toArray();
        return $this->response->array($info);
    }
    public function listLogs(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        \Log::info('getting logs for user ' . $user);
        $workspace = $this->getWorkspace( $request );
        $logs = DebuggerLog::select(array('debugger_logs.*', 'flows.name AS flow_name'));
        $logs->leftJoin('flows', 'flows.id', '=', 'debugger_logs.flow_id');
        $logs->where('debugger_logs.workspace_id', $workspace->id);
        $searchables = ['from', 'to', 'flow_id'];
        foreach ($searchables as $search) {
          $value = $request->get($search);
          if (!empty($value)) {
            $logs->where("debugger_logs.$search" , "like", "%" . $value .  "%");
          }
        }
        return $this->response->paginator($logs->paginate($paginate), new DebuggerLogTransformer);
    }
}

