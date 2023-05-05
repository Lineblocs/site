<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\BalanceResource;

class BillingTax extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "billing_taxes";
  public function isFederal() {
    return $this->federal;
  }
  public function isPrimary() {
    return $this->primary_tax;
  }
}


