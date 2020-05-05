<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Recording;

final class RecordingTransformer extends TransformerAbstract {
     public function transform(Recording $recording)
    {
        $array = $recording->toArray();
        return $array;
    }
}
