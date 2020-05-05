<?php

namespace App\Http\Controllers\Api;
use \App\Http\Controllers\Controller;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Api\ApiAuthController;



class HasStripeController extends ApiAuthController {
     use Helpers;
     public function __construct() {
          parent::__construct();
          $this->initStripe();
     }
    public function initStripe() {
        $stripe = \Config::get("stripe");
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
    }
}
