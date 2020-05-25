<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class Call extends ApiResource {
  protected $dates = ['created_at', 'updated_at', 'started_time', 'ended_tiem'];

  protected $guarded  = array('id');
  public static $apiPrefix = "call";
  public function toArray() {
        $live = time() - $this->created_at->getTimestamp();
        $array['duration_live'] = $live;
        $array['duration_live_human'] = MainHelper::secondsToHumanReadable($array['duration_live']);
        if ($array['status'] == 'ended') {
          $array['duration_ended'] = $this->ended_at->getTimestamp() - $this->started_at->getTimestamp();
          $array['duration_ended_human'] = MainHelper::secondsToHumanReadable($array['duration_ended']);
        }
        return $array;
      }
}


