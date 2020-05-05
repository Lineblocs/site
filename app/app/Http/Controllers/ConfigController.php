<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiAuthController;
use Config;

class ConfigController extends ApiAuthController
{

    public function getConfig(Request $request)
    {
        $data = [];
        $data['stripe'] = [];
        $data['stripe']['key'] = Config::get("stripe.public_key");
        return $this->response->array($data);
    }
}
