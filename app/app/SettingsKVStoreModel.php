<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use DB;
use Schema;

class SettingsKVStoreModel extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');

  public static function getKVPairs() {
    $kvPairs = self::all();
    $result = [];
    foreach ($kvPairs as $row) {
      switch ($row['value_type']) {
        case 'string':
          $result[$row['key']] = $row['string_value'];
        break;
        case 'number':
          $result[$row['key']] = $row['number_value'];
        break;
        case 'boolean':
          if ( $row['boolean_value'] ) {
            $result[$row['key']] = TRUE;
          } else {
            $result[$row['key']] = FALSE;
          }
        break;
      }
    }

    return $result;
  }
  public function toArray() {
    $kvPairs = self::getKVPairs();
    return $kvPairs;
  }

  public static function getRecord($additionalColumns=false) {
    $clazzName = get_called_class();
    $clazz = new $clazzName;

    $array = self::getKVPairs();
    foreach ($array as $key => $value) {
      if (!empty($key)) {
        $clazz->{$key} = $value;
      }
    }

    return $clazz;
  }

  // TODO improve code performance and look into migrating to
  // laravel native functions when upgrading from 5.x to another version
  public static function upsert($key, $valueTypeColumn, $value) {
    $row = self::where('key', $key)->first();
    $parts = explode("_", $valueTypeColumn);
    $valueType = $parts[0];

    if ($row) {
      return $row->update([
        'value_type' => $valueType,
        $valueTypeColumn => $value
      ]);
    }

    return self::create([
      'key' => $key,
      'value_type' => $valueType,
      $valueTypeColumn => $value
    ]);
  }
}


