<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationQuestionnaire extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "registration_questionnaire";
  public function toArray() {
    $array = parent::toArray();
    $array['choices'] = json_decode($array['choices'], TRUE);
    return $array;
  }
}


