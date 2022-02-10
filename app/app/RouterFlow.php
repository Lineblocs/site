<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class RouterFlow extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array();
  protected $casts = array(
    "started" => "boolean"
  );
  public static function createFromTemplate($template_name, $user, $category='pstn') {

    $template = RouterFlowTemplate::where('name', $template_name)->first();
      $json = $template->flow_json;
      $flow = RouterFlow::create([
        'admin_id' => $user->id,
        'name' => $name,
        'flow_json' => $json,
        'category' => $category
      ]);
       
      return $flow;

  }
  public function toArray()
  {
    return parent::toArray();
  }
}
