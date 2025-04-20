<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_otp',
        'phone_otp',
        'type',
        'gst',
        'offering',
        'email_verified_at',
        'phone_verified_at',
        'on_board_completed',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function address(){
        return $this->hasOne(Address::class,'user_id','id');
    }

    public function product(){
        return $this->hasMany(Product::class,'user_id','id');
    }

    public function category(){
        return $this->hasMany(BusinessCategory::class,'user_id','id');
    }

    public function categories()
{
    return $this->hasManyThrough(
        Category::class,         // Final model
        BusinessCategory::class, // Intermediate model
        'user_id',               // Foreign key on BusinessCategory table
        'id',                    // Foreign key on Category table (referenced by BusinessCategory)
        'id',                    // Local key on User
        'category_id'            // Local key on BusinessCategory pointing to Category
    );
}

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            do {
                $uuid = Str::uuid();
            } while (User::where('uuid', $uuid)->exists()); // Ensure uniqueness

            $user->uuid = $uuid;
        });
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

}
