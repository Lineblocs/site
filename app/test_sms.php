<?php
$curl = curl_init();
$number = "17808503688";
$body = urlencode("Test an SMS");
curl_setopt_array($curl, array(
CURLOPT_URL => "https://http-api.d7networks.com/send?username=usjc8191&password=mPuZESOt&dlr-method=POST&dlr=no&to=$number&content=$body&from=SMSinfo",
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
echo "HTTP code: " . $httpcode.PHP_EOL;
curl_close($curl);
echo $response;


