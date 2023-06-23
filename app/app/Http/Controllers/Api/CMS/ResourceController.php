<?php

namespace App\Http\Controllers\Api\CMS;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\Resource;
use \App\ResourceTag;
use \App\ResourceDefinition;
use \App\ResourceIndividualSetting;
use \App\Transformers\ResourceListTransformer;
use \App\Transformers\ResourceTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use App\Helpers\EmailHelper;
use Mail;
use Config;



class ResourceController extends ApiAuthController {
    public function list(Request $request) {
        $resources = Resource::all();
        $paginate = $this->getPaginate( $request );
        MainHelper::addSearch($request, $resources, ['title']);
        return $this->response->paginator($carriers->paginate($paginate), new ResourceListTransformer);
    }
    public function getResource(Request $request, $key) {
        $resource = Resource::where('key_name', $key)->firstOrFail();
        return $this->response->paginator($carriers->paginate($paginate), new ResourceItemTransformer);
    }
}

