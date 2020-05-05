<?php

$fullPath = __DIR__."/../fs/files/" . $_REQUEST['path'];
if (!file_exists($fullPath)) {
  header("HTTP/1.0 404 Not Found", true, 404);
  echo "<h1>"._("Error 404 Not Found")."</h1>";
  echo _("File not Found!");
  die();
}

$type = mime_content_type($fullPath);
$content = file_get_contents($fullPath);
header("Content-Type: $type");
echo $content;
