<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Extension;

final class ExtensionTransformer extends TransformerAbstract {
     public function transform(Extension $extension)
    {
        $array = $extension->toArray();
        return $array;
    }
}
