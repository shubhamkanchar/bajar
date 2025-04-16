<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city',
        'state',
        'pincode',
        'address'
    ];

    public function getFullAddressAttribute(){
        return $this->address.', '.$this->city.', '.$this->state;
    }
}
