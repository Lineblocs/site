<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\File;

final class FileTransformer extends TransformerAbstract {
     public function transform(File $file)
    {
        $array = $file->toArray();
        return $array;
    }
}
