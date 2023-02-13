<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiAuthController;
use Config;
use Illuminate\Http\Request;

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
