<?php
namespace App\Helpers;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\DIDNumber;
use App\Extension;
use App\Workspace;
use App\Flow;
use App\FlowTemplate;
use App\ExtensionCode;
use Config;
use Auth;
use DB;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\User;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTime;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\CallRate;
use App\CallRateDialPrefix;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Mail;


final class PlanHelper {
public static function minutes_to_seconds($minutes)
{
  return $minutes * 60;
}
public static function gb_to_kb($gb) {
  return $gb * 1024;
}
public static function create_plan($attrs=[])
{
  $defaults = [
    'key_name' => '',
    'nice_name' => '',
    'base_costs' => 0.00,
    'call_duration' => 'Unlimited',
    'recording_space' => 'Unlimited',
    'minutes_per_month' => 0,
    'extensions' => 5,
    'ports' => TRUE,
    'extensions' => 5,
    'recording_space' => 1024,
    'fax' => 100,
    'calling_between_ext' => TRUE,
    'standard_call_feat' => TRUE,
    'voicemail_transcriptions' => FALSE,
    'im_integrations' => FALSE, 
    'productivity_integrations' => FALSE,
    'voice_analytics' => FALSE,
    'fraud_protection' => FALSE,
    'crm_integrations' => FALSE,
    'programmable_toolkit' => FALSE,
    'sso' => FALSE,
    'provisioner' => FALSE,
    'vpn' => FALSE,
    'multiple_sip_domains' => FALSE,
    'bring_carrier' => FALSE,
    'call_center' => FALSE,
    '247_support' => FALSE,
    'ai_calls' => FALSE,
    'benefits' => []
  ];
  $result = [];
  foreach ($defaults as $key => $item) {
    $result[ $key ] = $item;
    if ( array_key_exists($key, $attrs) ) {
      $result[ $key ] = $attrs[ $key ];
    }
  }
  return $result;
}

}
