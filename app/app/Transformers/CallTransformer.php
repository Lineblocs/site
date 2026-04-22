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
        $createdAt = $call['created_at'];
        $updatedAt = $call['updated_at'];

        $array['friendly_duration'] = MainHelper::formatDuration($array['duration']);
        $array['friendly_dates'] = [
            'created_at' => MainHelper::createHumanReadableDate($createdAt),
            'updated_at' => MainHelper::createHumanReadableDate($updatedAt),
        ];
        return $array;
    }
}
