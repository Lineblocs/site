<?php

namespace App\Helpers\Sms;

final class D7NetworksHelper extends Base {

    public static function getProviderName() {
        return 'd7networks';
    }
    public function sendSMS($from='', $to='', $body='') {
        $user = $this->key;
        $pass = $this->secret;
        $curl = curl_init();
        $body = urlencode($body);
        curl_setopt_array($curl, array(
        //CURLOPT_URL => "https://http-api.d7networks.com/send?username=$user&password=$pass&dlr-method=POST&dlr=no&to=$to&content=$body&from=SMSinfo",
        CURLOPT_URL => "https://http-api.d7networks.com/send?username=$user&password=$pass&dlr-method=POST&dlr=no&to=$to&content=$body&from=$from",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //echo "HTTP code: " . $httpcode.PHP_EOL;
        curl_close($curl);
        if ($httpcode >= 200 && $httpcode <= 299) {
        return TRUE;
        }
        return FALSE;
    }

}