<?php

namespace App\Http\Controllers\Api\Internal\Debugger;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Workspace;
use \App\Call;
use \App\Recording;
use \App\DebuggerLog;
use \App\Transformers\CallTransformer;
use \App\Helpers\MainHelper;
use DateTime;
use DateInterval;
use Config;
use Mail;
use Exception;
use Log;



class LogController extends ApiAuthController {
  private function startLogRoutine($level, $params, $workspace, $creator) {
      if ($level == 'error') {
        $workspace = Workspace::findOrFail($params['workspace_id']);
        $creator = User::findOrFail($workspace->creator_id);
        $data = [
          'params' => $params,
          'workspace' => $workspace,
          'creator' => $creator
        ];
        $mail = Config::get('mail');
        $log = DebuggerLog::create($params);
        Log::info(sprintf("
          Sending log to: %s, 

          Title: %s
          Report: %s
        ", $creator->email, $params['title'], $params['report']));
        try {
          Mail::send('emails.debugger_error', $data, function ($message) use ($mail, $creator) {
              $message->to($creator->email);
              $message->subject("Lineblocs.com - Debugger Error");
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
        } catch (Exception $ex) {
          Log::info("could not send logger to " . $creator->email);
          return $log;
        }
      }

      return $log;


  }
    public function createLog(Request $request)
    {
      $data = $request->json()->all();
      $level = 'info';
      if ( isset ( $data['level'] ) ) {
        $level = $data['level'];
      }
      $from = "";
      if ( !empty($data['from']) ) {
        $from = $data['from'];
      }
      $to = "";
      if ( !empty($data['tom']) ) {
        $to = $data['to'];
      }

      $params = [
        'from' => $from,
        'to' => $to,
        'title' => $data['title'],
        'report' => $data['report'],
        'workspace_id' => $data['workspace_id'],
        'level' => $level
      ];
      if (isset($data['flow_id'])) {
        $params['flow_id'] = $data['flow_id'];
      }
      $workspace = Workspace::findOrFail($data['workspace_id']);
      $creator = User::findOrFail($workspace->creator_id);
      $log =$this->startLogRoutine($level, $params, $workspace, $creator);
      return $this->response->array($log->toArray())->withHeader("X-Log-ID", $log->id);
    }
     public function createLogSimple(Request $request)
    {
      \Log::info("headers are: " . json_encode( $request->headers->all() ) );
      $data = $request->all();
      $level = 'info';
      if ( isset ( $data['level'] ) ) {
        $level = $data['level'];
      }
      \Log::info("body is: " . $request->getContent());
      $workspace = MainHelper::workspaceByDomain($data['domain']);
      $creator = User::findOrFail($workspace->creator_id);
      $title = '';
      $report = '';
      switch ($data['type']) {
        case 'verify-callerid-cailed':
          $title = 'Caller ID Verify failed..';
          $report = 'Caller ID Verify failed..';
      break;
      }

      $params = [
        'from' => '',
        'to' => '',
        'title' => $title,
        'report' => $report,
        'workspace_id' => $workspace->id,
        'level' => $level
      ];

      $log =$this->startLogRoutine($level, $params, $workspace, $creator);
      return $this->response->noContent();
    }
}

