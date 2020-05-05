<?php
namespace App\Http\Controllers;
use \View;
class BaseController extends Controller
{
  public function __construct()
  {
  // Sharing is caring
  $info = [
    'footer_title' => '',
    'footer_bio' => ''
  ];
    View::share('info', $info);
  }
}
