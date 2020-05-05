<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Phone;

final class PhoneTransformer extends TransformerAbstract {
     public function transform(Phone $phone)
    {
        $array = $phone->toArray();
        $array['model_friendly'] = sprintf("%s %s", $phone->manufacturer, $phone->model);
        $array['needs_provisioning_friendly'] = 'No';
        if ($phone->needs_provisioning) {
            $array['needs_provisioning_friendly'] = 'Yes';
        }
        $array['group_friendly'] = 'None';
        if (isset($phone->group)) {
          $array['group_friendly'] = $phone->group;
        }

        return $array;

    }
}
