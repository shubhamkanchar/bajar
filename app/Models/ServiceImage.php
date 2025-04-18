<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'service_id',
        'path',
        'order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
