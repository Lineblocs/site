<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use Exception;
use Log;
use Illuminate\Support\Facades\DB;

class ApiCredentialGroup2 extends SettingsRecord {
  protected $dates = ['created_at', 'updated_at'];
  protected $casts = array(
  );

  protected $guarded  = array('id');

  protected $table  = 'api_credentials_group2';
}


