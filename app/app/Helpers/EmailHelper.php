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
  public static function sendEmail($subject, $to, $template, $data) {
    $customizations = Customizations::getRecord();
    $dns_provider = $customizations->dns_provider;
    $mail = Config::get('mail');
    $data['customizations'] = $customizations;
    $data['site_name'] = MainHelper::getSiteName();
    if ( $customizations->mail_provider == 'smtp-gateway') {
      try {
        Mail::send('emails.'.$template, $data, function ($message) use ($subject, $to, $mail) {
            $message->to($to);
            $message->subject($subject);
            $from = $mail['from'];
            $message->from($from['address'], $from['name']);
        });
      } catch (Exception $ex) {
        Log::error('could not send email. tried sending email with template: ' . $template . ' data was: ' . json_encode($data));
        return $ex->getMessage();
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
