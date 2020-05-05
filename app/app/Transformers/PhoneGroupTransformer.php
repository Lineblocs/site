<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\PhoneGroup;

final class PhoneGroupTransformer extends TransformerAbstract {
     public function transform(PhoneGroup $group)
    {
        $array = $group->toArray();
        return $array;
    }
}
