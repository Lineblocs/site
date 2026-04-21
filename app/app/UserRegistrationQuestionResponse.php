<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegistrationQuestionResponse extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "user_registration_question_responses";
}


