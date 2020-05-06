<?php

namespace App\Http\Controllers\Api\PortNumber;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\PortNumber;
use \App\UserDebit;
use \App\Flow;
use \App\Transformers\PortNumberTransformer;
use \App\ThirdParty\NumberService;
use \App\Helpers\MainHelper;
use \App\Helpers\WorkspaceHelper;
use App\PortNumberDocument;
use \Input;
use \Mail;
use \Config;


class PortNumberController extends ApiAuthController {
     public static $acceptedDocumentFormats = array("pdf", "doc", "docx");
      public static $maxDocumentSizeBytes = 10000000;
      public static $maxDocumentSizeReadable = "10MB";
    private function uploadDoc(Request $request, $document, $type, $number) {
        if (!$document->isValid()) {
        \Log::error(sprintf("docment invalid"));
        return;
        }
        $user = $this->getUser($request);
        $size = $document->getSize();
        $extension = $document->guessExtension();
        \Log::info(sprintf("uploading file size: %d, format is %s", $size, $extension));
        if (!in_array($extension, self::$acceptedDocumentFormats)) {
          return FALSE;
        }
        $fileName = uniqid(TRUE).".".$extension;
        if ( $size > self::$maxDocumentSizeBytes ) {
          return FALSE;
        }
        $document->move(\Config::get("app.document_save_dir"), $fileName);
        //$url = implode("/", array( \Config::get("app.url"), "documents", $fileName ) );
        $documentObj = PortNumberDocument::create([
            'number_id' => $number->id,
            'user_id' => $user->id,
            'filename' => $fileName,
            'type' => $type
        ]);
        return TRUE;
    }
    private function uploadDocs(Request $request, $number)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $loa = Input::file("loa");
        if ($loa) {
          $status = $this->uploadDoc($request, $loa, 'loa', $number);
          if (!$status) {
            return FALSE;
          }
        }

        $csr = Input::file("csr");
        if ($csr) {
          $status = $this->uploadDoc($request, $csr, 'csr', $number);
          if (!$status) {
            return FALSE;
          }

        }

        $invoice = Input::file("invoice");
        if ($invoice) {
          $status = $this->uploadDoc($request, $invoice, 'invoice', $number);
          if (!$status) {
            return FALSE;
          }

        }
        return TRUE;

    }
    public function saveNumber(Request $request)
    {
        $data = $request->except(['loa', 'csr', 'invoice']);
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
      
        $number = PortNumber::create(array_merge($data, array(
          "workspace_id" => $workspace->id,
          'user_id' => $user->id,
          'status' => 'pending-review',
        )));
        if (!$this->uploadDocs($request, $number)) {
          $number->delete();
          return $this->errorInternal(sprintf("One of the documents could not be uploaded please be sure to upload a file size less than %s and use one of the following file formats: %s", self::$maxDocumentSizeReadable, implode(",", self::$acceptedDocumentFormats)));
        }
        $mail = Config::get("mail");
        $mailData = compact('user','workspace', 'number');
          Mail::send('emails.port_started', $mailData, function ($message) use ($user, $mail) {
              $message->to($user->email);
              $message->subject("Lineblocs.com - Port Number Request Started");
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
        return $this->response->noContent();
    }
    public function updateNumber(Request $request, $numberId)
    {
        $data = $request->except(['loa', 'csr', 'invoice']);
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $number = PortNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_ports')) {
            return $this->response->errorForbidden();
        }
        $number->update( $data );
        if (!$this->uploadDocs($request, $number)) {
          return $this->errorInternal(sprintf("One of the documents could not be uploaded please be sure to upload a file size less than %s and use one of the following file formats: %s", self::$maxDocumentSizeReadable, implode(",", self::$acceptedDocumentFormats)));
        }
          Mail::send('emails.port_updated', $data, function ($message) use ($user, $mail) {
              $message->to($user->email);
              $message->subject("Lineblocs.com - Port Number Request Updated");
              $from = $mail['from'];
              $message->from($from['address'], $from['name']);
          });
        return $this->response->noContent();
    }
    public function numberData(Request $request, $numberId)
    {
        $number = PortNumber::where('public_id', '=', $numberId)->firstOrFail();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'manage_ports')) {
            return $this->response->errorForbidden();
        }
        $documents = [];
        $loa =PortNumberDocument::where('number_id', $number->id)->where('type', 'loa')->orderBy('created_at', 'desc')->firstOrFail();
        $documents[] = $loa->toArray();
        $csr =PortNumberDocument::where('number_id', $number->id)->where('type', 'csr')->orderBy('created_at', 'desc')->firstOrFail();
        $documents[] = $csr->toArray();
        $invoice =PortNumberDocument::where('number_id', $number->id)->where('type', 'invoice')->orderBy('created_at', 'desc')->firstOrFail();
        $documents[] = $invoice->toArray();

        $result = $number->toArray();

        $result['documents'] = $documents;
        return $this->response->array($result);
    }
    public function listNumbers(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $workspace = $this->getWorkspace($request);
        $numbers = PortNumber::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $numbers, ['number', 'status', 'provider']);
        return $this->response->paginator($numbers->paginate($paginate), new PortNumberTransformer);
    }
    public function deleteNumber(Request $request, $numberId)
    {
        $data = $request->json()->all();
        $number = PortNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_ports')) {
            return $this->response->errorForbidden();
        }
        $number->delete();
        return $this->response->noContent();
    }


}

