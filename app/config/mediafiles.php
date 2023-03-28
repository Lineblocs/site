<?php
use App\Helpers\MainHelper;
$default = MainHelper::createSubdomainUrl("s3fs", "/");

return [
  'url' => env('MEDIAFILES_URL', $default),
];