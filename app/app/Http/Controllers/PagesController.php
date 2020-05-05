<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends BaseController {

  public function privacyPolicy()
  {
    return view('pages.privacy_policy');
  }

  public function termsOfService()
  {
    return view('pages.terms_of_service');
  }
}

