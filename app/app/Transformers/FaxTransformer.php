<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Fax;

final class FaxTransformer extends TransformerAbstract {
     public function transform(Fax $fax)
    {
        $array = $fax->toArray();
        return $array;
    }
}
