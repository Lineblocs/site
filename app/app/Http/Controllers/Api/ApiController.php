<?php

namespace App\Http\Controllers\Api;
use \App\Http\Controllers\Controller;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;



class ApiController extends Controller {
   use Helpers;
   public function getJWTUser() {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
   }
   public function makeApiLocation($path) {
        return "/api/".$path;
   }
   public function getPaginate($request)
   {
     if ($request->has("per_page")) {
          return (int)$request->get("per_page");
     }
     return 10;
   }
}
