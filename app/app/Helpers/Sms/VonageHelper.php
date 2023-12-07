<?php

namespace App\Helpers\Sms;

use App\ApiCredential;

final class VonageHelper extends Base {

    public static function getProviderName() {
        return 'vonage';
    }
    public function sendSMS($from='', $to='', $body='') {
        $creds = ApiCredential::getRecord();
        $apiKey = $creds->vonage_api_key;
        $apiSecret =$creds->vonage_api_secret;
    }

}