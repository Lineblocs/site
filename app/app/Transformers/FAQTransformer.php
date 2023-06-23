<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\FAQ;
use App\Helpers\MainHelper;

final class FAQTransformer extends TransformerAbstract {
     public function transform(FAQ $faq)
    {
      $array = $faq->toArray();
 
        return $array;
    }
}
