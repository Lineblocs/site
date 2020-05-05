<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Workspace;
use App\Helpers\MainHelper;

final class WorkspaceTransformer extends TransformerAbstract {
     public function transform(Workspace $workspace)
    {
        $array = $workspace->toArray();
        return $array;
    }
}
