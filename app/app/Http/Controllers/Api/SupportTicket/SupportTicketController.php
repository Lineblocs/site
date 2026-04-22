<?php

namespace App\Http\Controllers\Api\SupportTicket;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\SupportTicket;
use \App\SupportTicketCategory;
use \App\UserDebit;
use \App\Flow;
use \App\Transformers\SupportTicketTransformer;
use \App\NumberService\NumberService;
use \App\Helpers\MainHelper;
use \App\Helpers\EmailHelper;
use \App\Helpers\WorkflowTraits\SupportTicket\SupportTicketWorkflow;
use \DB;
use Mail;
use Config;



class SupportTicketController extends ApiAuthController {
    use SupportTicketWorkflow;
}

