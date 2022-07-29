<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\SIPTrunk;

final class TrunkTransformer extends TransformerAbstract {
     public function transform(SIPTrunk $trunk)
    {
        $array = $trunk->toArray();
        return $array;
    }
}
