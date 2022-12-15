<?php

return [
  'voipms' => [
    'api_username' => env('VOIPMS_API_USERNAME',''),
    'api_password' => env('VOIPMS_API_PASSWORD',''),
    'account_no' => env('VOIPMS_ACCOUNT_NO',''),
    'sub_account_no' => env('VOIPMS_SUBACCOUNT_NO',''),
    'main_pop' =>env('VOIPMS_MAIN_POP','52')
  ]
];
