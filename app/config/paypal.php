<?php
$keys = [];

$keys['dev'] = [
  'mode' => 'sandbox',
  'client_id' => 'AUg44E_fXk7_5t6SIY5yJR7DyowJlJJV6CHvdC16E6LTNp966QhS3xs1u4P7bt2sUaSN-G9_d_1iXHoz',
  'client_secret' => 'EPcgN91q4lFT6XFv7vIrl5DjxNa_u1bDEU6L49GF_cE-5VoCVCKqCDwWo8ZB2-cM6Yp8MAkKPKjxWSpJ'
];
$keys['prod'] = [
  'mode' => 'live',
  'client_id' => 'AYDzaZmhC1oowqEq6s9P6CiwU9XGjT8cgAA7rBabB2fyFyLu5hpStx291b0IRsu0VuV18bWKg9-kn9_J',
  'client_secret' => 'EI-KJ16Fk4Ky3wXksxSKOsXxOSBgcXyCw37E_JfQnNExm10SDmmLuYlWyypwOtkpiXBWdCDS9iUthU3b'
];
if (env('APP_DEBUG')) {
  return $keys['dev'];
}
return $keys['prod'];
