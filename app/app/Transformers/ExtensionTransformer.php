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
        //online ?
        $last = $extension->last_registered;
        if (!empty($last)) {
            $now = time();
            $time = $extension->last_registered->getTimestamp();
            $expires = $extension->register_expires;
            if ( ($time + $expires) < $now ) {
                $array['registered']=FALSE;
            } else {
                $array['registered']=TRUE;
            }

        }
        return $array;
    }
}
