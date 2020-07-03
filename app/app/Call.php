<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;

class Call extends ApiResource {
  protected $dates = ['created_at', 'updated_at', 'started_at', 'ended_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "call";
  public function getDuration() {
    $duration = $this->ended_at->getTimestamp() - $this->started_at->getTimestamp();
    return $duration;
  }
  public function toArray() {
        $array = parent::toArray();
        $live = time() - $this->created_at->getTimestamp();
        $array['duration_live'] = $live;
        $array['duration_live_human'] = MainHelper::secondsToHumanReadable($array['duration_live']);
        if (!empty($array['status']) && $array['status'] == 'ended' && $this->ended_at != null) {
          $array['duration_ended'] = $this->getDuration();
          $array['duration_ended_human'] = MainHelper::secondsToHumanReadable($array['duration_ended']);
        }
        return $array;
      }
}


