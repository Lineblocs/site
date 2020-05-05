<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\DebuggerLog;

final class DebuggerLogTransformer extends TransformerAbstract {
     public function transform(DebuggerLog $log)
    {
        $array = $log->toArray();
        return $array;
    }
}
