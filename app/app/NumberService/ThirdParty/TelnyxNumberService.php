<?php 
namespace App\NumberService\ThirdParty;
use Config;
use Session;
use App\NumberService\NumberService;
final class TelnyxNumberService {

    public static function cachePut($key, $value)
    {
      Session::put($key, $value);
    }
     public static function cacheGet($key)
    {
      return Session::get($key);
    }

    public static function internal($endpoint, $data, $method="POST")
    {
      $telnyx = Config::get("telnyx");
      $data_string = json_encode($data);                                                                                   
                                                                                                                           
      $ch = curl_init($endpoint);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      

      $headers = array(                                                                          
          'x-api-token: ' . $telnyx['api_token'],
          'x-api-user: ' . $telnyx['api_user'],
      );
      if ($method != "GET") {
           
          $headers[] = 'Content-Type: application/json';
          $headers[] = 'Content-Length: ' . strlen($data_string);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                                                                           
      $result = curl_exec($ch);
      return json_decode($result);
    }

    public function listNumbersAPI($country, $region, $prefix)
    {
      $descriptor = [];
      $search_type = 1; //NPA
      $descriptor['country_iso'] = $country; 
      if ($region) {
            $search_type = 2; //NPA
            $descriptor['region'] = $region;
      } elseif ($prefix) {
            $search_type = 1; //NPA
            $descriptor['npa'] = $prefix;
            $descriptor['region'] = 'Edmonton';
      }
      $payload = [
        "search_type" => $search_type,
        "search_descriptor" => $descriptor
      ]; 
      $results = TelnyxNumberService::internal("https://api.telnyx.com/origination/number_searches",  $payload);
      $numbers = [];
      foreach ($results->result as $result) {
        $addedCost = $result->monthly_recurring_cost;
        $region = $result->regional_data->rate_center;
        $number = $result->number_e164;

        $numbers[] = [
          'number' => $number,
          'monthly_cost' => $addedCost,
          'region' => $region
        ];
        $costKey = $number."_cost";
        TelnyxNumberService::cachePut($costKey, $addedCost);
        $regionKey = $number."_region";
        TelnyxNumberService::cachePut($regionKey, $region);

      }
      return $numbers;  
    }
     public function register($workspace, $type, $number, $region=NULL, $cost=NULL)
    {
      $telnyx = Config::get("telnyx");
      $payload = [
        "requested_numbers" => [
          $number
        ],
        'connection_id' => $telnyx['connection_id']
      ];
      $result = TelnyxNumberService::internal("https://api.telnyx.com/origination/number_orders", $payload);
      $costKey = $number."_cost";
      $cost = TelnyxNumberService::cacheGet($costKey);
      $regionKey = $number."_region";
      $region = TelnyxNumberService::cacheGet($regionKey);
      return [
        'monthly_cost' => $cost,
        'region' => $region,
        'provider' => 'TELNYX',
        'provider_id' => $number
      ];

    }
    public static function data($number)
    {
      return NumberService::internal("https://api.telnyx.com/origination/numbers/$number",NULL, "GET");
    }
}
