<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Recording;
use App\Helpers\MainHelper;

final class RecordingTransformer extends TransformerAbstract {
     public function transform(Recording $recording)
    {
        $array = $recording->toArray();
        $createdAt = $recording['created_at'];
        $updatedAt = $recording['updated_at'];

        $array['friendly_dates'] = [
            'created_at' => MainHelper::createHumanReadableDate($createdAt),
            'updated_at' => MainHelper::createHumanReadableDate($updatedAt),
        ];

        return $array;
    }
}
