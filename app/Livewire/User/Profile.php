<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Profile extends Component
{
    public $tab = "product";
    public function render()
    {
        return view('livewire.user.profile')->extends('layouts.profile-layout');
    }

    public function removeFromWishlist($id)
    {
        $user = Auth::user();
        $model = $this->tab === 'product' ? Product::class : Service::class;

        $user->wishlist()
            ->where('wishable_type', $model)
            ->where('wishable_id', $id)
            ->delete();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Removed from wishlist'
        ]);
    }

    public function wishlistProductIds()
    {
        return Auth::user()
            ->wishlist()
            ->where('wishable_type', Product::class)
            ->pluck('wishable_id')
            ->toArray();
    }

    #[Computed]
    public function Products()
    { 
        $wishlistId = Auth::user()->wishlist()
            ->where('wishable_type', Product::class)
            ->pluck('wishable_id')
            ->toArray();
        return Product::with(['images', 'category'])->whereIn('id', $wishlistId)->get();
    }

    #[Computed]
    public function services()
    { 
        $wishlistId = Auth::user()->wishlist()
            ->where('wishable_type', Service::class)
            ->pluck('wishable_id')
            ->toArray();
        return Service::with(['images', 'category'])->whereIn('id', $wishlistId)->get();
    }
}
