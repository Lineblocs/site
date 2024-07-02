<?php

namespace App\Helpers\Sms;

use App\ApiCredential;
use App\ApiCredentialKVStore;

final class VonageHelper extends Base {

    public static function getProviderName() {
        return 'vonage';
    }
    public function sendSMS($from='', $to='', $body='') {
        $creds = ApiCredentialKVStore::getRecord();
        $apiKey = $creds->vonage_api_key;
        $apiSecret =$creds->vonage_api_secret;
    }

}