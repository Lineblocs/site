<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CompanyRepresentative extends Model {

  protected $dates = ['created_at', 'updated_at', 'expires_on'];

  protected $guarded  = array('id');
  protected $table = "company_representatives";
  protected $casts = array(
    "main_contact" => "boolean"
  );
  public static function getMainContact() {
    return self::where('main_contact', '1')->first();
  }
}


