<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nonmonetary extends Model
{
    // Specify the correct table name
    protected $table = 'non_monetary_donations';

    // Allow mass assignment for these fields
    protected $fillable = [
        'category', 'condition', 'donor_name', 'donor_email', 'donor_phone',
        'dropoff_location', 'image', 'preferred_time', 'description'
    ];
}
