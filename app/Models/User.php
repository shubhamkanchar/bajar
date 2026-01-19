<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function service()
    {
        return $this->hasMany(Service::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->hasMany(BusinessCategory::class, 'user_id', 'id');
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

    // public function ratings(){
    //     return  $this->hasOne(ProductSellerReview::class,'seller_id','id')->select('seller_id',DB::raw('SUM(communication_and_professionalism + quality_or_service + recommendation) as total_score'))
    //     ->groupBy('seller_id');
    // }

    public function ratings(){
        return  $this->hasOne(ProductSellerReview::class,'seller_id','id')->select('seller_id',DB::raw('count(communication_and_professionalism) as total_score'))
        ->groupBy('seller_id');
    }

    public function getBussinessTimeAttribute()
    {
        $time = BusinessTime::where([
            'user_id' => $this->id,
            'day' => date("l")
        ])->first();
        if ($time && $time['open_time'] && $time['close_time']) {
            return date("g:i A", strtotime($time['open_time'])) . ' - ' . date("g:i A", strtotime($time['close_time']));
        }
        return 'Closed';
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->latest(); // Optional: gets the most recent one
    } 

    public function latestSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->latest(); // Optional: gets the most recent one
    } 
}
