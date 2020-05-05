<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\WidgetTemplate;
use App\Helpers\MainHelper;

final class WidgetTemplateTransformer extends TransformerAbstract {
     public function transform(WidgetTemplate $template)
    {
        $array = $template->toArray();
        return $array;
    }
}
