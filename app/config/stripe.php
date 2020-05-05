<?php
$mode = 'test';
$keys = [];
$keys['dev'] = [
    'public_key' => 'pk_test_eMSvl9uZ9hAmHdIXuX3FVYqf',
    'secret_key' => 'sk_test_VfSO7KWidwZFKCSPgL8X23r8'
];
$keys['prod'] = [
    'public_key' => 'pk_live_PUqyFyRcGQRJzJjqYHh2q9Mt',
    'secret_key' => 'sk_live_XyRu0OIhRnlKjf3BvyHecpqy'
];
if (env('APP_DEBUG')) {
  return $keys['dev'];
}
return $keys['prod'];
