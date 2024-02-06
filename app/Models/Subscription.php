<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'data',
        'order_reference',
        'status',
        'period',
        'payment_intent',
        'package',
        'transaction_id',
        'user_id',
        'number'
    ];

    protected $casts = [
        'data' => 'json',
        'order_reference' => 'json',
        'status' => 'json',
        'period' => 'json',
        'payment_intent' => 'json'
    ];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
