<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Call;
use App\Helpers\MainHelper;

final class CallTransformer extends TransformerAbstract {
     public function transform(Call $call)
    {
        $array = $call->toArray();
        return $array;
    }
}
