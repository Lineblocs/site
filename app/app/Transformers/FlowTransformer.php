<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Flow;

final class FlowTransformer extends TransformerAbstract {
     public function transform(Flow $flow)
    {
        $array = $flow->toArray();
        return $array;
    }
}
