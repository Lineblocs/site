<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\BYOCarrier;

final class CarrierTransformer extends TransformerAbstract {
     public function transform(BYOCarrier $carrier)
    {
        $array = $carrier->toArray();
        return $array;
    }
}
