<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\PortNumber;
use App\Helpers\MainHelper;

final class PortNumberTransformer extends TransformerAbstract {
     public function transform(PortNumber $number)
    {
        $array = $number->toArray();
        return $array;
    }
}
