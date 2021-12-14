<?php

namespace App\Http\Controllers;

class HealthzController extends BaseController {
  public function healthz()
  {
    return response("OK");
  }
}