<?php

namespace App\Helpers\WorkflowTraits\SupportTicket;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Helpers\SupportHelper;
use \App\SupportTicket;
use \App\SupportTicketTag;
use \App\UserDebit;
use \App\Flow;
use \App\Transformers\SupportTicketTransformer;
use App\SupportTicketService\SupportTicketService;
use \App\Helpers\MainHelper;
use \DB;
use Mail;
use Config;



trait SupportTicketWorkflow {
    public function saveSupportTicket(Request $request)
    {
        $data = $request->only('subject', 'comment', 'priority');
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $subject = sprintf("[Workspace %s] %s", $workspace->name, $data['subject']);
        $comment = $data['comment'];
        $priority = $data['priority'];
        $id = SupportHelper::createTicket($subject, $comment, $priority);
        SupportTicket::create([
            'comment' => $comment,
            'priority' => $priority,
            'subject' => $subject,
            'zendesk_id' => $id
        ]);

        return $this->errorInternal($request, 'Provision extension error..');
    }
    public function updateSupportTicket(Request $request, $supportTicketId)
    {
        $args = $request->all();

        $supportTicket = SupportTicket::where('public_id', '=', $supportTicketId)->firstOrFail();
        if (!$this->hasPermissions($request, $supportTicket, 'manage_support_tickets')) {
            return $this->response->errorForbidden();
        }

        SupportHelper::updateTicket($supportTicket->zendesk_id, $args);
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
        return $this->response->array($array);
    }
    public function listSupportTickets(Request $request)
    {
        $workspace = $this->getWorkspace($request);
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        $supportTickets = SupportTicket::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $supportTickets, ['subject']);
        return $this->response->paginator($supportTickets->paginate($paginate), new SupportTicketTransformer);
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