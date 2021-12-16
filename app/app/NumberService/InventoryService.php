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
use App\NumberInventory;
use DB;

class InventoryService extends NumberService {
    public function __construct() {
    }
    public function getName() {
      return "Inventory";
    }
    private function mapNumber($country,$type,$result) {
          $attrs = [
            'country' => $country,
            'api_number' => $result['api_number'],
            'number' => $result['number'],
            'region' => $result['region'],
            'monthly_cost' => $result['monthly_cost'],
            'setup_cost' => $result['setup_cost'],
            'features' => implode($result['features']),
            'provider' => 'Inventory',
            'type' => $type
          ];
          return $this->numberArray($attrs);
    }
     public function register($workspace, $type, $number, $region=NULL, $cost=NULL)
    {
      $number=NumberInventory::where('api_number', $number)->firstOrFail();
      $number->update(['reserved_by'=>$workspace->id]);
      return TRUE;
    }
    public function listNumbersAPI($country, $region, $prefix="", $rateCenter="", $type="local", $for="voice", $extras=[])
    {
        $numbers = NumberInventory::select(
            array('number_inventory.id', 
            'number_inventory.number',
            'number_inventory.region', 
            DB::raw('sip_providers.id AS provider_id'), 
            'number_inventory.created_at')
        );
        $numbers->join('sip_providers', 'sip_providers.id', '=', 'number_inventory.provider_id');
        $numbers->whereNull('number_inventory.reserved_by')
              ->where('number_inventory.region', $region)
              ->where('number_inventory.country', $country)
              ->where('number_inventory.type', $type)
              ->where('number_inventory.number', 'like', $prefix.'%');
        $result=[];
        foreach ($numbers->get() as $item){
            $result[] =$this->mapNumber($country,$type,$item);

        }

        return $result;
    }
    public function unrent($number)
    {
      $number=NumberInventory::where('api_number', $number)->firstOrFail();
      $number->update(['reserved_by'=>NULL]);
      return TRUE;
    }
}

