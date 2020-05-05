<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\FlowTemplate;

final class FlowTemplateTransformer extends TransformerAbstract {
     public function transform(FlowTemplate $template)
    {
        $array = $template->toArray();
        return $array;
    }
}
