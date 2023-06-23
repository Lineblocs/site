<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Resource;
use App\Helpers\MainHelper;

final class ResourceListTransformer extends TransformerAbstract {
     public function transform(Resource $item)
    {
      $array = $item->toArray();
 
        return $array;
    }
}
