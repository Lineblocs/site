<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Trunk;

final class TrunkTransformer extends TransformerAbstract {
     public function transform(Trunk $flow)
    {
        $array = $flow->toArray();
        return $array;
    }
}
