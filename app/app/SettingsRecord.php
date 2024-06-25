<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use DB;
use Schema;

class SettingsRecord extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');

  public static function getRecord($additionalColumns=false) {
    $all_columns = self::getColumns();
    $exclude_columns = [];
    if (!$additionalColumns) {
      $exclude_columns[] = 'opensips_config';
    }
    $get_columns = array_diff($all_columns, $exclude_columns);

    return self::select($get_columns)->first();
  }
  public static function getColumns() {
    $db = DB::connection()->getPdo();
    $table = with(new static)->getTable();

    $rs = $db->query(sprintf('SELECT * FROM %s LIMIT 0', $table));
    for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = $col['name'];
    }
    //print_r($columns);
    return $columns;
  }
}


