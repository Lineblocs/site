<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\PhoneIndividualSetting;

final class PhoneIndividualSettingTransformer extends TransformerAbstract {
     public function transform(PhoneIndividualSetting $setting)
    {
        $array = $setting->toArray();
        return $array;
    }
}
