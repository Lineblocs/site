<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\MacroTemplate;

final class MacroTemplateTransformer extends TransformerAbstract {
     public function transform(MacroTemplate $template)
    {
        $array = $template->toArray();
        $array['changeable_params'] = json_decode($array['changeable_params'],TRUE);
        return $array;
    }
}
