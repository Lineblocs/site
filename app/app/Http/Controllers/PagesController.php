<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\MainHelper;
use App\Helpers\EmailHelper;
use App\User;
use \Config;
use \Mail;
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

  public function serviceAgreement(){
    // return view('pages.service_level_agreement');
    $email = 'tgblinkss@gmail.com';
    $user = User::findOrFail(234);

    $link = route('email-verify', ['hash' => $user->email_verify_hash]);
    $data = [
          'user' => $user,
          'link' => $link
        ];
    $subject =MainHelper::createEmailSubject("Verify Your Email");
    $result = EmailHelper::sendEmail($subject, $email, 'verify_email', $data);

    return json_encode($result);
  }
}

