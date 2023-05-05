<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\BalanceResource;

class UserInvoice extends BalanceResource {
  protected $dates = ['created_at', 'updated_at', 'complete_date', 'due_date', 'last_attempted'];

  protected $guarded  = array('id');
  protected $table = "users_invoices";
  protected $casts = [
    'tax_metadata' => 'array'
  ];
}


