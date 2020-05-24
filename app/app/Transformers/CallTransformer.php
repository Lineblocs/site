<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Call;

final class CallTransformer extends TransformerAbstract {
     public function transform(Call $call)
    {
        $array = $call->toArray();
        $live = time() - $call->created_at->getTimestamp();
        $array['duration_live'] = $live;
        return $array;
    }
}
