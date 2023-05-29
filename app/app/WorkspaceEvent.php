<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WorkspaceEvent extends Model {

  protected $dates = ['created_at', 'updated_at', 'expires_on'];

  protected $guarded  = array('id');
  protected $table = "workspaces_events";
  public static function addEvent($workspace, $type, $props=array()) {
    $event = self::create([
      'type' => $type,
      'workspace_id' => $workspace->id,
      'plan_snapshot' => $workspace->plan
    ]);
    foreach ( $props as $key => $value ) {
      WorkspaceEventProperty::create([
        'event_id' => $event->id,
        'key' => $key,
        'value' => $value
      ]);
    }
    return $event;
  }
}


