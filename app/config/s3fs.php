<?php
use App\Helpers\MainHelper;
$default = MainHelper::createSubdomainUrl("s3fs", "/");


return [
  'url' => env('S3FS_URL', $default),
];
