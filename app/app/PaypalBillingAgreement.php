<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalBillingAgreement extends Model
{
    protected $table = 'billing_agreements';

    protected $fillable = [
        'user_id',
        'workspace_id',
        'agreement_id',
        'state',
        'description',
        'start_date',
        'payer_email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
