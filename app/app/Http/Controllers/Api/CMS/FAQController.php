<?php

namespace App\Http\Controllers\Api\CMS;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\FAQ;
use \App\FAQTag;
use \App\FAQDefinition;
use \App\FAQIndividualSetting;
use \App\Transformers\FAQTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\EmailHelper;
use Mail;
use Config;



class FAQController extends ApiAuthController {
    public function list(Request $request) {
        $faq = FAQ::all();
        $paginate = $this->getPaginate( $request );
        MainHelper::addSearch($request, $faq, ['title']);
        return $this->response->paginator($carriers->paginate($paginate), new FAQTransformer);
    }
}

