<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FlowTemplatePreset extends Model {
  protected $dates = ['created_at', 'updated_at'];
  protected $table = "flow_templates_presets";

  protected $guarded  = array();
  public static function create(array $attrs = array()) {
    if ( !empty($attrs['extras'])) {
      $attrs['extras'] = json_encode($attrs['extras']);
    }
    return parent::create($attrs);
  }
}
