<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\PhoneGlobalSetting;

final class PhoneGlobalSettingTransformer extends TransformerAbstract {
     public function transform(PhoneGlobalSetting $setting)
    {
        $array = $setting->toArray();
        return $array;
    }
}
