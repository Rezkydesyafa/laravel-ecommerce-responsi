<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'snap_token',
        'payment_type',
        'phone',
        'address',
        'city',
        'postal_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
