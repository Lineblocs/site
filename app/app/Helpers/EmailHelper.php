<?php

namespace App\Helpers;
use App\Helpers\MainHelper;
use App\Classes\namecheap;
use App\SIPTrunk;
use App\SipTrunkTermination;
use App\Customizations;
use Config;
use Log;
use Exception;
use Mail;
final class EmailHelper {
  public static function sendEmail($to, $template, $data) {
    $customizations = Customizations::getRecord();
    $dns_provider = $customizations->dns_provider;
    $mail = Config::get('mail');
    if ( $customizations->mail_provider == 'smtp-gateway') {
      try {
        Mail::send('emails.'.$template, $data, function ($message) use ($user, $mail) {
            $message->to($user->email);
            $message->subject("Lineblocs.com - Verify Your Email");
            $from = $mail['from'];
            $message->from($from['address'], $from['name']);
        });
      } catch (Exception $ex) {
        Log::error('could not send email. tried sending email with template: ' . $template . ' data was: ' . json_encode($data));
        return FALSE;
      }
      return TRUE;
    } else if ( $customizations->mail_provider == 'ses') {
      // TODO: implement
      return TRUE;
    } else if ( $customizations->mail_provider == 'mailgun') {
      // TODO: implement
      return TRUE;
    }
    return FALSE;
  }
}
