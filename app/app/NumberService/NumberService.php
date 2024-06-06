<?php
namespace App\NumberService;
use Config;
use Session;
use Log;
use App\Helpers\MainHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPProvider;
use DB;
use App\NumberService\ThirdParty\VoIPMSNumberService;
use App\NumberServiceConfig;
use App\NumberService as NumberServiceData;

abstract class NumberService {
    public $isUsable = false;

    public static function listNumbers($country, $region, $prefix, $center=NULL, $params=array()){
        $amount = 50;
      $providers =  SIPProvider::select(DB::raw("DISTINCT(sip_providers.id), sip_providers.api_name, sip_regions.code, sip_countries.iso"));
      //$providers =  SIPProvider::select(DB::raw("sip_providers.api_name, sip_regions.code, sip_countries.iso"));
      $providers->leftJoin('sip_rate_centers_providers', 'sip_rate_centers_providers.provider_id', '=', 'sip_providers.id');
      $providers->leftJoin('sip_rate_centers', 'sip_rate_centers.id', '=', 'sip_rate_centers_providers.center_id');
      $providers->leftJoin('sip_regions', 'sip_regions.id', '=', 'sip_rate_centers.region_id');
      $providers->leftJoin('sip_countries', 'sip_countries.id', '=', 'sip_regions.country_id');
      if (!empty($center)) {
        $providers->where('sip_rate_centers.name', '=', $center);
      } else {
        if (!empty($region)) {
          $providers->where('sip_regions.code', '=', $region);
        }
        $providers->where('sip_countries.iso', '=', $country);
      }
      $providers = $providers->get();
      $type = 'local';
      if (!empty($params['number_type'])) {
        $type = $params['number_type'];
      }
      $for = 'voice';
      if (!empty($params['number_for'])) {
        $for = $params['number_for'];
      }
      $extras = [];
      if (!empty($params['vanity_prefix']))
      {
        $extras['vanity_prefix'] = $params['vanity_prefix'];
      }
       if (!empty($params['vanity_pattern']))
      {
        $extras['vanity_pattern'] = $params['vanity_pattern'];
      }

      $numbers = [];

      // first check inventory
      Log::info("looking up numbers in inventory");
      $inventory = new \App\NumberService\InventoryService();
      $inventoryNumbers = $inventory->listNumbersAPI($country, $region, $prefix, $center, $type, $for, $extras);
      list( $numbers, $exceededAllowedAmount ) = NumberService::addNumbers( $numbers, $inventoryNumbers, $amount );

      foreach ($providers as $provider) {
        if ( $exceededAllowedAmount ) {
          break;
        }

        Log::info("looking up numbers with provider " . $provider->api_name);

        $numberSvc = NumberService::getProvider($provider->api_name);
        if (!$numberSvc->isUsable) {
          Log::debug(sprintf("%s API is not usable", $provider->api_name));
          continue;
        }
        $providerNumbers = $numberSvc->listNumbersAPI($country, $region, $prefix, $center, $type, $for, $extras);
        list( $numbers, $exceededAllowedAmount ) = NumberService::addNumbers( $numbers, $providerNumbers, $amount );
        if ( $exceededAllowedAmount ) {
          break;
        }
      }
      return NumberService::sortProviderNumbers($numbers);
    }

    public static function addNumbers($allNumbers, $numbers, $totalAllowed)
    {
        $addedNumbers = $allNumbers + $numbers;
        if (count($addedNumbers) > $totalAllowed) {
          $remains = $totalAllowed - count($numbers);
          $take = array_slice($addedNumbers, count($allNumbers), $remains);
          $allNumbers = $allNumbers + $take;
        } else {
          $allNumbers = $addedNumbers;
        }
        if (count($allNumbers)==$totalAllowed) {
          return [$allNumbers, TRUE];
        }
        return [$allNumbers, FALSE];
      }

    public static function sortProviderNumbers($numbers) {
      return $numbers;
    }
    abstract public function register($workspace, $type, $number, $region=NULL, $cost=NULL);
    abstract public function unrent($number);
    abstract public function getName();
    public function getNumberFields() {
      return [
        'provider' => $this->getName()
      ];
    }
    public function numberArray($params) {
      return $this->getNumberFields() + $params;
    }
    public static function getProvider($name) {
      if ( $name=='Inventory') {
        return new \App\NumberService\InventoryService();

      }

      // lookup number service data for this API provider
      $serviceData = NumberServiceData::where('key_name', $name)->first();
      $serviceConfig = NumberServiceConfig::getValues($serviceData->id);

      $full = "\\App\\NumberService\\ThirdParty\\".$name."NumberService";
      return new $full($serviceData, $serviceConfig);
    }

    public static function getDIDProvider($country) {
      return new VoIPMSNumberService();
    }

}
