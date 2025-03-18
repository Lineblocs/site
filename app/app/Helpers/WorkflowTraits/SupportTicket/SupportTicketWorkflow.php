<?php

namespace App\Helpers\WorkflowTraits\SupportTicket;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Helpers\SupportHelper;
use \App\SupportTicket;
use \App\SupportTicketUpdate;
use \App\SupportTicketCategory;
use \App\UserDebit;
use \App\Flow;
use App\Customizations;
use App\CustomizationsKVStore;
use \App\Transformers\SupportTicketTransformer;
use App\SupportTicketService\SupportTicketService;
use \App\Helpers\MainHelper;
use \App\Helpers\EmailHelper;
use \DB;
use Input;
use Mail;
use Config;



trait SupportTicketWorkflow {
    private function uploadAttachment(Request $request, $fileKey) {
        $attachment = Input::file($fileKey);
        if (empty($attachment) || ($attachment && !$attachment->isValid())) {
            \Log::error(sprintf("attachment $fileKey is invalid, not processing"));
            return;
        }
        $user = $this->getUser($request);
        $size = $attachment->getSize();
        $extension = $attachment->guessExtension();
        \Log::info(sprintf("uploading file size: %d, format is %s", $size, $extension));
        if (!in_array($extension, self::$acceptedDocumentFormats)) {
          return FALSE;
        }
        $fileName = uniqid(TRUE).".".$extension;
        if ( $size > self::$maxDocumentSizeBytes ) {
          return FALSE;
        }
        $attachment->move(\Config::get("app.document_save_dir"), $fileName);
        return $fileName;
    }


    public function saveSupportTicket(Request $request)
    {
        $customizations = CustomizationsKVStore::getRecord();
        $data = $request->only('subject', 'comment', 'priority');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);

        $subject = sprintf("[Workspace %s] %s", $workspace->name, $data['subject']);
        $comment = $data['comment'];

        $zendeskEnabled = $customizations->zendesk_enabled;
        $supportTicketId = NULL;
        if ($zendeskEnabled) {
            $supportTicketId = SupportHelper::createTicket($subject, $comment, $priority);
        }
        //$priority = $data['priority'];
        $priorityForUserTickets = 'LOW';
        $openingStatus = 'OPEN';


        $supportTicket= SupportTicket::create([
            'comment' => $comment,
            'subject' => $subject,
            'status' => $openingStatus,
            'zendesk_id' => $supportTicketId,
            'priority' => $priorityForUserTickets,
            'workspace_id' => $workspace->id,
            'user_id' => $user->id,
        ]);

        //return $this->errorInternal($request, 'Provision extension error..');
        // send email notification about new support ticket
        $subject = "New support ticket created";
        $link = MainHelper::createUrl('/admin/supportticket/?id='.$supportTicket->id);
        $data = [
            'user' => $user,
            'ticket' => $supportTicket,
            'ticketLink' => $link
        ];
        $feedbackLink = MainHelper::createUrl('/leave-feedback');
        if ($customizations->app_feedback_enabled) {
            $result = EmailHelper::sendEmail($subject, $user->email, 'app_feedback_request', ['user' => $user, 'feedbackLink' => $feedbackLink]);
        }
        $result = EmailHelper::sendEmail($subject, $user->email, 'support_ticket_created', $data);
        return $this->response->array($supportTicket)->withHeader('X-Supportticket-ID', $supportTicket->public_id);
    }

    public function createSupportTicketUpdate(Request $request, $ticketId)
    {
        $customizations = CustomizationsKVStore::getRecord();
        $data = $request->only('comment');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $ticket = SupportTicket::where('public_id', $ticketId)->firstOrFail();

        $attachment1 = $this->uploadAttachment($request, "attachment1");
        $attachment2 = $this->uploadAttachment($request, "attachment2");
        $attachment3 = $this->uploadAttachment($request, "attachment3");

        $params = [
            'comment' => $data['comment'],
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'direction' => 'ENDUSER'
        ];
        if (!empty($attachment1)) {
            $params['attachment1'] = $attachment1;
        }
        if (!empty($attachment2)) {
            $params['attachment2'] = $attachment2;
        }
        if (!empty($attachment3)) {
            $params['attachment3'] = $attachment3;
        }

        $update= SupportTicketUpdate::create($params);
        $subject = "New support ticket updated";
        $data = [
            'user' => $user,
            'ticket' => $ticket,
            'update' => $update
        ];
        $result = EmailHelper::sendEmail($subject, $user->email, 'support_ticket_updated', $data);

        return $this->response->array($update->toArray());
    }

    public function getSupportTicketUpdates(Request $request, $ticketId)
    {
        $customizations = CustomizationsKVStore::getRecord();
        $ticketUpdates = SupportTicketUpdate::where('ticket_id', $ticketId)->get();
        return $this->response->array($ticketUpdates->toArray());
    }
    public function updateSupportTicket(Request $request, $supportTicketId)
    {
        $args = $request->all();

        $supportTicket = SupportTicket::where('public_id', '=', $supportTicketId)->firstOrFail();
        if (!$this->hasPermissions($request, $supportTicket, 'manage_support_tickets')) {
            return $this->response->errorForbidden();
        }
        $customizations = CustomizationsKVStore::getRecord();
        $zendeskEnabled = $customizations->zendesk_enabled;
        if ($zendeskEnabled) {
            SupportHelper::updateTicket($supportTicket->zendesk_id, $args);
        }
        $supportTicket->update($data);
    }
    public function supportTicketData(Request $request, $supportTicketId)
    { 
        $supportTicket = SupportTicket::select(DB::raw("support_tickets.*"));
        $supportTicket = $supportTicket->where('support_tickets.public_id', '=', $supportTicketId)->firstOrFail();
        if (!$this->hasPermissions($request, $supportTicket, 'manage_support_tickets')) {
            return $this->response->errorForbidden();
        }
        $array = $supportTicket->toArray();
        // get any updates
        $ticketUpdates = SupportTicketUpdate::select(array('support_tickets_updates.*', 'users.email', 'users.first_name', 'users.last_name'));
        $ticketUpdates->join('users', 'users.id', '=', 'support_tickets_updates.user_id');
        $ticketUpdates = $ticketUpdates->where('support_tickets_updates.ticket_id', $supportTicket->id)->get();

        $updates = [];
        foreach ( $ticketUpdates as $update ) {
            $item = $update->toArray();
            $attachments = [];
            if (!empty($update->attachment1)) {
               $attachments[] = $update->attachment1; 
            }
            if (!empty($update->attachment2)) {
               $attachments[] = $update->attachment2; 
            }
            if (!empty($update->attachment3)) {
               $attachments[] = $update->attachment3; 
            }
            $item['attachments'] = $attachments;
            $updates[] = $item;
        }

        $array['updates'] = $updates;
        return $this->response->array($array);
    }
    public function listSupportTickets(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $supportTickets = SupportTicket::where('workspace_id', $workspace->id);
        $supportTickets->orderBy('created_at', 'DESC');
        MainHelper::addSearch($request, $supportTickets, ['subject']);
        return $this->response->paginator($supportTickets->paginate($paginate), new SupportTicketTransformer);
    }

   public function listCategories(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $categories = SupportTicketCategory::all();
        return $this->response->array( $categories->toArray() );
    }
    public function deleteSupportTicket(Request $request, $supportTicketId)
    {
        $data = $request->json()->all();
        $supportTicket = SupportTicket::where('public_id', '=', $supportTicketId)->firstOrFail();
        if (!$this->hasPermissions($request, $supportTicket, 'manage_support_tickets')) {
            return $this->response->errorForbidden();
        }
        $supportTicket->delete();
        SupportHelper::deleteTicket($supportTicket->zendesk_id);
        return $this->response->noContent();
    }

}