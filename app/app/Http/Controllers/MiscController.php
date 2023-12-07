<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use App\SIPCountry;
use App\SIPRegion;
use App\UserEmailOption;
use App\SystemStatusCategory;
use App\SystemStatusUpdate;
use App\User;
use App\ServicePlan;
use App\Customizations;
use App\ApiCredential;
use App\Workspace;
use App\WorkspaceUser;
use App\Helpers\EmailHelper;
use App\Faq;
use App\CompanyRepresentative;
use DB;
use View;
use Illuminate\Http\Request;
use Config;
use Mail;
use App\Helpers\MainHelper;
use \ReCaptcha\ReCaptcha;

class MiscController extends BaseController {

  private function sendEmail( Request $request ) {
    $allData = $request->all()->json();
    $subject = $allData['subject'];
    $to = $allData['to'];
    $args = $allData['args'];
    $user= User::find( $data['user']['id'] );
    $workspace= Workspace::find( $data['workspace']['id'] );
    $args['user'] = $user;
    $args['workspace'] = $workspace;
    EmailHelper::sendEmail($subject, $to, $template, $args);
    return $this->response->noContent();
  }


}