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
        $live = time() - $call->created_at->getTimestamp();
        $array['duration_live'] = $live;
        if ($array['status'] == 'ended') {
          $array['duration_ended'] = $call->ended_at->getTimestamp() - $call->started_at->getTimestamp();
          $array['duration_ended_human'] = MainHelper::secondsToHumanReadable($array['duration_ended']);
        }
        return $array;
    }
}
