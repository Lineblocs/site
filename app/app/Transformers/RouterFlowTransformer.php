<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\RouterFlow;

final class RouterFlowTransformer extends TransformerAbstract {
     public function transform(RouterFlow $flow)
    {
        $array = $flow->toArray();
        return $array;
    }
}
