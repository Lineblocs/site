<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SystemStatusUpdate;

class SystemStatusCategory extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "system_status_categories";
  public function checkStatus() {
    $update = SystemStatusUpdate::where('category_id', $this->id)->orderBy('updated_at','DESC')->first();
    if (!$update) {
      return "UP";
    }
    return $update->status;
  }
  public function getPartialDegradation() {
    return [];
  }
  public function getDowntime() {
    return [];
  }
  public function getUpdates() {
    /*
    {
      id: 10,
      date: '10 October 2020',
      description: '100% uptime',
      status: 'uptime'
    },
    {
      id: 09,
      date: '09 October 2020',
      description: 'In Maintenance',
      status: 'maintenance'
    },
    {
      id: 08,
      date: '08 October 2020',
      description: 'In Maintenance',
      status: 'maintenance'
    },
    {
      id: 07,
      date: '07 October 2020',
      description: 'Downtime',
      status: 'downtime'
    },
    */
    $results = [];
    $days = $this->getLastNDays(7);
    foreach ( $days as $day ) {
      //lookup actual statuses this day
      $from = $day['day'];
      $to = $day['day_after'];
      $updates = SystemStatusUpdate::where('category_id', $this->id)->whereBetween('created_at', [$from, $to]);
      if ( $updates->count() == 0 ) {
        $results[] = [
          'id' => null,
          'status' => 'uptime',
          'date' => $day['day_friendly'], 
          'description' => '100% uptime'
        ];
        continue;
      }
      $all = $updates->get();
      $current = [];
      foreach ( $all as $item ) {
        if ( $item->status != 'UP' ) {
          if ( $item->status == 'DOWN') {
            $results[] = [
              'id' => null,
              'status' => 'downtime',
              'date' => $day['day_friendly'], 
              'description' => $item->description
            ];
          }
        }
      }
    }
    return $results;
  }
  private function getLastNDays($days, $format = 'Y-m-d'){
      $m = date("m"); $de= date("d"); $y= date("Y");
      $dateArray = array();
      $friendly_format = "d F y";
      for($i=0; $i<=$days-1; $i++){
          $day = $i;
          $dayafter = $i+1;
          $dateArray[] = array(
            "day" => date($format, mktime(0,0,0,$m,($de-$day),$y)),
            "day_friendly" => date($friendly_format, mktime(0,0,0,$m,($de-$day),$y)),
            "day_after" => date($format, mktime(0,0,0,$m,($de-$dayafter),$y))
          );
      }
      return $dateArray;
  }

}


