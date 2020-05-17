<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\BYODIDNumber;
use App\Helpers\MainHelper;

final class BYODIDNumberTransformer extends TransformerAbstract {
     public function transform(BYODIDNumber $number)
    {
        $array = $number->toArray();
        return $array;
    }
}
