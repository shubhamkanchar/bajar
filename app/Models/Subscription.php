<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'razorpay_subscription_id',
        'plan_id',
        'status',
        'start_at',
        'end_at',
        'payment_id',
        'plan_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
