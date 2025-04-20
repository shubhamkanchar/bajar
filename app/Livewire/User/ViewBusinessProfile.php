<?php

namespace App\Livewire\User;


use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewBusinessProfile extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $editProductId;
    public $selectedCategory = 'all';
    public $user;
    
    #[
        Validate(
            rule: ['product_images.*' => 'required|image|max:1024'],
            message: [
                'product_images.*.required' => 'Please add image.',
                'product_images.*.image' => 'The image must be a valid image file.',
                'product_images.*.max' => 'The image cannot be larger than 1MB.',
            ]
        )
    ]
    public $product_images = [
        'product_image1' => null,
        'product_image2' => null,
        'product_image3' => null,
        'product_image4' => null,
        'product_image5' => null,
        'product_image6' => null,
    ];

    public $showPrice = true;
    public $price;
    public $description;
    public $brand_name;
    public $product_name;
    public $quantity;
    public $category;
    public $product_tag_group_id;

    public function mount($uuid){
        $this->user = $uuid ? User::firstWhere('uuid', $uuid) :Auth::user();
    }

    #[Computed]
    public function bussinessTime()
    {
        $time = BusinessTime::where([
            'user_id' => Auth::user()->id,
            'day' => date("l")
        ])->first();
        if($time && $time['open_time'] && $time['close_time']) {
            return date("g:i A", strtotime($time['open_time'])).' - '.date("g:i A", strtotime($time['close_time']));
        }
        return 'Closed';
    }
    
    public function editProduct($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $this->editProductId = $id;
        $this->product_name = $product->name;
        $this->brand_name = $product->brand_name;
        $this->description = $product->description;
        $this->category = $product->category_id;
        $this->showPrice = $product->show_price;
        $this->product_tag_group_id = $product->product_tag_group_id;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
    
        foreach ($product->images as $index => $image) {
            $this->product_images['product_image' . ($index + 1)] = $image->path;
        }

        $this->isEdit = true;
    }
    
    #[Computed]
    public function allProducts()
    {
        if($this->selectedCategory == 'all') {
            return Product::with(['images', 'category'])->where('user_id', $this->user->id)->get()->groupBy('category.title');
        }
        return Product::with(['images', 'category'])->where(['user_id' => $this->user->id, 'category_id' => $this->selectedCategory])->get()->groupBy('category.title');
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'product')->get();
    }

    #[Computed]
    public function businessCategories() {
        $ids = Product::where('user_id', $this->user->id)->pluck('category_id');
        return Category::where('type', 'product')->whereIn('id', $ids)->get();
    }

    public function changeCategory($value) {
        $this->selectedCategory = $value;
    }

    public function resetProduct() {
        $this->reset([
            'isEdit',
            'editProductId',
            'product_images',
            'product_name',
            'brand_name',
            'description',
            'category',
            'showPrice',
            'product_tag_group_id',
            'price',
            'quantity'
        ]);
    }

    public function toggleWishlist($productId)
    {
        $user = Auth::user();

        $existing = $user->wishlist()
            ->where('wishable_id', $productId)
            ->where('wishable_type', Product::class)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            $user->wishlist()->create([
                'wishable_id' => $productId,
                'wishable_type' => Product::class,
            ]);
        }
    }

    #[Computed]
    public function wishlistProductIds()
    {
        return Auth::user()
            ->wishlist()
            ->where('wishable_type', Product::class)
            ->pluck('wishable_id')
            ->toArray();
    }
    public function render()
    {
        return view('livewire.user.view-business-profile')->extends('layouts.profile-layout');;
    }
}
