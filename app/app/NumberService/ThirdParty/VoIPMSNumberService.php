<?php
namespace App\NumberService\ThirdParty;
use Config;
use Session;
use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;
use App\Classes\VoIPms;
class VoIPMSNumberService extends NumberService {
    public function __construct() {
      // login
      $this->config = Config::get("number_services.voipms");
      $this->clazz = new VoIPms();
      $this->clazz->api_username = $this->config['api_username'];
      $this->clazz->api_password =  $this->config['api_password'];
    }
    public function getName() {
      return "VoIPMS";
    }
    private function mapNumbers($country, $results) {
        foreach ($results as $item) {
            $attrs = [
              'country' => $country,
              'api_number' => $item['did'],
              'number' => MainHelper::toE164($item['did']),
              'region' => $item['ratecenter'],
              'monthly_cost' => $item['perminute_monthly'],
              'setup_cost' => $item['perminute_monthly'],
              'features' => ['voice'],
              'type' => 'local'
            ];

            $numbers[] = $this->numberArray($attrs);
          }
      return $numbers;

    }
    private function mapNumbersTollFree($country, $results) {
        foreach ($results as $item) {
            $attrs = [
              'country' => $country,
              'api_number' => $item['did'],
              'number' => MainHelper::toE164($item['did']),
              //'region' => $item['ratecenter'],
              'monthly_cost' => $item['monthly'],
              'setup_cost' => $item['monthly'],
              'features' => ['voice'],
              'type' => 'toll-free'
            ];

            $numbers[] = $this->numberArray($attrs);
          }
      return $numbers;

    }
     private function mapNumbersVanity($country, $results) {
        foreach ($results as $item) {
            $attrs = [
              'country' => $country,
              'api_number' => $item['did'],
              'number' => MainHelper::toE164($item['did']),
              //'region' => $item['ratecenter'],
              'monthly_cost' => $item['monthly_canadian'],
              'setup_cost' => $item['setup_canadian'],
              'features' => ['voice'],
              'type' => 'vanity'
            ];

            $numbers[] = $this->numberArray($attrs);
          }
      return $numbers;

    }
    public function listNumbersAPI($country, $region, $prefix="", $rateCenter="", $type="local", $for="voice", $extras=[])
    {
      if ( $type=="local") {
        if ($country == 'CA') {
          if ($for=="voice") {
            $response = $this->clazz->getDIDsCAN($region, $rateCenter);
            $numbers = [];
            if ($response['status'] == 'success') {
              $results = $this->filterPrefix($response['dids'], $prefix);
              return $this->mapNumbers($country, $results);
            }
          } elseif ($for=="fax") {

            //$response = $this->clazz->searchFaxAreaCodeCAN("780");
            return [];
          }
        } elseif ($country == 'US') {
           //$this->clazz->getRateCentersUSA(
          if ($for=="voice") {
            $response = $this->clazz->getDIDsUSA($region, $rateCenter);
            $numbers = [];
            if ($response['status'] == 'success') {
              $results = $this->filterPrefix($response['dids'], $prefix);
              return $this->mapNumbers($country, $results);
            }
          } elseif ($for=="fax") {
            return [];
          }
        }
      } elseif ($type=="toll-free") {
          if ($for == 'voice') {
            if (empty($prefix)) {
              $prefix = "844";
            }
            $response = $this->clazz->searchTollFreeCanUS('starts', $prefix);
            $numbers = [];
            if ($response['status'] == 'success') {
              $results = $response['dids'];
              return $this->mapNumbersTollFree($country, $results);
            }
          } elseif ($for=='fax') {
            return [];
          }

      } elseif ($type=="vanity") {
          if ($for == 'voice') {
            $prefix = $extras['vanity_prefix'];
            $pattern = $extras['vanity_pattern'];
            if (empty($prefix)) {
              $prefix = "8**";
            }
            $response = $this->clazz->searchVanity($prefix, $pattern);
            $numbers = [];
            if ($response['status'] == 'success') {
              $results = $response['dids'];
              return $this->mapNumbersVanity($country, $results);
            }
          } elseif ($for=='fax') {
            return [];
          }

      }
      return $numbers;
    }
    public function register($workspace, $type, $number, $region=NULL, $cost=NULL)
    {
      if ($type=='local') {
        //$routing = "account:" . $this->config['account_no'];
        $routing = "account:" . $this->config['sub_account_no'];
        $failover_busy = NULL;
        $failover_unreachable = NULL;
        $failover_noanswer = NULL;
        $voicemail = NULL;
        $pop = $this->config['main_pop'];
        $dialtime = "60";
        $cnam = "0";
        $callerid_prefix = NULL;
        $note = NULL;
        $billing_type = "1";
        $account = NULL;
        $monthly = NULL;
        $setup = NULL;
        $minute = NULL;
        $test = 0;

        $order = $this->clazz->orderDID($number, 
          $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
          $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $billing_type,
          $account, $monthly, $setup, $minute, $test);
        if ($order['status'] == 'success') {
          return TRUE;
        }
        return FALSE;
      } elseif ($type=='toll-free') {
        //$routing = "account:" . $this->config['account_no'];
        $routing = "account:" . $this->config['sub_account_no'];
        $failover_busy = NULL;
        $failover_unreachable = NULL;
        $failover_noanswer = NULL;
        $voicemail = NULL;
        $pop = $this->config['main_pop'];
        $dialtime = "60";
        $cnam = "0";
        $callerid_prefix = NULL;
        $note = NULL;
        $billing_type = "1";
        $account = NULL;
        $monthly = NULL;
        $setup = NULL;
        $minute = NULL;
        $test = 0;

        $order = $this->clazz->orderTollFree($number, 
          $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
          $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $account,  $monthly, $setup, $minute);

        if ($order['status'] == 'success') {
          return TRUE;
        }
        return FALSE;


      } elseif ($type=='vanity') {
        //$routing = "account:" . $this->config['account_no'];
        $routing = "account:" . $this->config['sub_account_no'];
        $failover_busy = NULL;
        $failover_unreachable = NULL;
        $failover_noanswer = NULL;
        $voicemail = NULL;
        $pop = $this->config['main_pop'];
        $dialtime = "60";
        $cnam = "0";
        $callerid_prefix = NULL;
        $note = NULL;
        $billing_type = "1";
        $account = NULL;
        $monthly = NULL;
        $setup = NULL;
        $minute = NULL;
        $test = 0;
        $carrier = "3"; //Canadian carrier
        $order = $this->clazz->orderVanity($number, 
          $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
          $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $carrier, $account, $monthly, $setup, $minute);

        if ($order['status'] == 'success') {
          return TRUE;
        }
        return FALSE;


      }

    }
    public function unrent($number)
    {
        $cancelcomment = NULL;
        $portout = NULL;
        $test = 0;
        $cancel = $this->clazz->cancelDID($number, $cancelcomment, $portout, $test);
        \Log::info("voip.ms cancel DID result is " . json_encode($cancel));
       if ($cancel['status'] == 'success') {
        return TRUE;
      }
      return FALSE;
    }
    public function filterPrefix($results, $prefix) {
      $return = [];
      if (empty($prefix)) {
        return $results;
      }
      foreach ($results as $result) {
        if (preg_match("/^$prefix/", $result['did'], $matches)) {
          $return[] = $result;
        }
      }
        return $return;
    }
}
