<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSellerReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'seller_id',
        'is_contact_accurate',
        'is_location_accurate',
        'communication_and_professionalism',
        'quality_or_service',
        'recommendation',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
