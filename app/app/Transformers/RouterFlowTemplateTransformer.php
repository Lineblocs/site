<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\RouterFlowTemplate;

final class RouterFlowTemplateTransformer extends TransformerAbstract {
     public function transform(RouterFlowTemplate $template)
    {
        $array = $template->toArray();
        return $array;
    }
}
