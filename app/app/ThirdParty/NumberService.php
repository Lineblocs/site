<?php
namespace App\ThirdParty;
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
abstract class NumberService {
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
      foreach ($providers as $provider) {
        $provider = NumberService::getProvider($provider->api_name) ;
        $providerNumbers = $provider->listNumbersAPI($country, $region, $prefix, $center, $type, $for, $extras);
        $addedNumbers = $numbers + $providerNumbers;
        if (count($addedNumbers) > $amount) {
          $remains = $amount - count($numbers);
          $take = array_slice($addedNumbers, count($numbers), $remains);
          $numbers = $numbers + $take;
        } else {
          $numbers = $addedNumbers;
        }
        if (count($numbers)==$amount) {
          break;
        }
      }
      return NumberService::sortProviderNumbers($numbers);
    }
    public static function sortProviderNumbers($numbers) {
      return $numbers;
    }
    abstract public function register($type, $number, $region=NULL, $cost=NULL);
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
      $full = "\\App\\ThirdParty\\".$name."NumberService";
      return new $full;
    }

    public static function getDIDProvider($country) {
      return new VoIPMSNumberService();
    }

}
