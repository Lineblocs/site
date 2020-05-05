<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\DIDNumber;
use App\Helpers\MainHelper;

final class DIDNumberTransformer extends TransformerAbstract {
     public function transform(DIDNumber $number)
    {
        $map = array(
          "ready-to-use" => "Ready To Use",
          "pending-in-review" => "Pending In Review"
        );
        $array = $number->toArray();
        $array['monthly_cost'] = MainHelper::formatNumber($array['monthly_cost']);
        $array['features'] = ''; 
        if (!empty($number->features)) {
          $array['features'] = explode(",", $number->features);
        }
        if (array_key_exists($number->availability, $map)) {
          $array['availability'] = $map[ $number->availability ];
        }
        return $array;
    }
}
