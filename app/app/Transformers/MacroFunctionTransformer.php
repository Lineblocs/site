<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\MacroFunction;

final class MacroFunctionTransformer extends TransformerAbstract {
     public function transform(MacroFunction $function)
    {
        $array = $function->toArray();
        return $array;
    }
}
