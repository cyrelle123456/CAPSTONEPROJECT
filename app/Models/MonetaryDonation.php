<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonetaryDonation extends Model
{
    protected $fillable = [
        'payment_method', 'amount', 'donor_name', 'donor_email', 'donor_phone', 'proof', 'message'
    ];
}
