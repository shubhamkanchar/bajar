<?php

namespace App\Livewire\User;

use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProductSellerReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ViewBusinessProfile extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $editProductId;
    public $selectedCategory = 'all';
    public $user;
    public $isLoaded = false;
    
    // For products
    public $product_images = [
        'product_image1' => null,
        'product_image2' => null,
        'product_image3' => null,
        'product_image4' => null,
        'product_image5' => null,
        'product_image6' => null,
    ];

    public $service_images = [
    ];

    public $showPrice = true;
    public $price;
    public $description;
    public $brand_name;
    public $product_name;
    public $quantity;
    public $category;
    public $product_tag_group_id;

    // For services
    public $service_description;
    public $work_brief;
    public $service_category;
    public $service_tag_group_id;

    //rating form
    public $authUserRating;
    public $showReviewForm = false;   
    public $showDetailSlider = false;   
    public $is_location_accurate; 
    public $is_contact_accurate; 
    public $communication_and_professionalism;
    public $quality_or_service;
    public $recommendation;

    public function mount($uuid){
        $this->user = $uuid ? User::firstWhere('uuid', $uuid) : Auth::user();
        $this->authUserRating = ProductSellerReview::where('seller_id', $this->user->id)->where('customer_id', auth()->id())->first(); 
        if($this->authUserRating) {
            $this->is_contact_accurate = $this->authUserRating->is_contact_accurate;
            $this->is_location_accurate = $this->authUserRating->is_location_accurate;
            $this->communication_and_professionalism = $this->authUserRating->communication_and_professionalism;
            $this->quality_or_service = $this->authUserRating->quality_or_service;
            $this->recommendation = $this->authUserRating->recommendation;
        }
    }

    #[Computed]
    public function bussinessTime()
    {
        $time = BusinessTime::where([
            'user_id' => $this->user->id,
            'day' => date("l")
        ])->first();
        if($time && $time['open_time'] && $time['close_time']) {
            return date("g:i A", strtotime($time['open_time'])).' - '.date("g:i A", strtotime($time['close_time']));
        }
        return 'Closed';
    }

    #[Computed]
    public function bussinessRatingsCount()
    {
        $data = ProductSellerReview::where([
            'seller_id' => $this->user->id,
            'is_expert' => 1
        ])
        ->count();
        return $data;
    }

    public function openReviewSlider(){
        $this->showReviewForm = true;
    }
    
    public function editProduct($id)
    {
        if ($this->user->offering === 'product') {
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
        } else {
            $service = Service::findOrFail($id);
            $this->editProductId = $id;
            $this->service_description = $service->description;
            $this->work_brief = $service->work_brief;
            $this->service_category = $service->category_id;
            $this->service_tag_group_id = $service->service_tag_group_id;
            foreach ($service->images as $index => $image) {
                $this->service_images[($index + 1)] = $image->path;
            }
        }

        $this->isEdit = true;
    }
    
    #[Computed]
    public function allItems()
    { 
        if(!$this->isLoaded) {
            return [];
        }
        
        if ($this->user->offering === 'product') {
            if($this->selectedCategory == 'all') {
                return Product::with(['images', 'category'])->where('user_id', $this->user->id)->get()->groupBy('category.title');
            }
            return Product::with(['images', 'category'])->where(['user_id' => $this->user->id, 'category_id' => $this->selectedCategory])->get()->groupBy('category.title');
        } else {
            if($this->selectedCategory == 'all') {
                return Service::with('category')->where('user_id', $this->user->id)->get()->groupBy('category.title');
            }
            return Service::with('category')->where(['user_id' => $this->user->id, 'category_id' => $this->selectedCategory])->get()->groupBy('category.title');
        }
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', $this->user->offering)->get();
    }

    #[Computed]
    public function businessCategories() {
        if ($this->user->offering === 'product') {
            $ids = Product::where('user_id', $this->user->id)->pluck('category_id');
        } else {
            $ids = Service::where('user_id', $this->user->id)->pluck('category_id');
        }
        return Category::where('type', $this->user->offering)->whereIn('id', $ids)->get();
    }

    public function changeCategory($value) {
        $this->selectedCategory = $value;
    }

    public function resetProduct() {
        $this->reset([
            'product_images',
            'product_name',
            'brand_name',
            'description',
            'category',
            'showPrice',
            'product_tag_group_id',
            'price',
            'quantity',
            'service_description',
            'work_brief',
            'service_category',
            'service_tag_group_id'
        ]);
    }

    public function toggleWishlist($id)
    {
        $user = Auth::user();
        $type = $this->user->offering === 'product' ? Product::class : Service::class;

        $existing = $user->wishlist()
            ->where('wishable_id', $id)
            ->where('wishable_type', $type)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            $user->wishlist()->create([
                'wishable_id' => $id,
                'wishable_type' => $type,
            ]);
        }
    }

    public function updatedShowReviewForm($value)
    {
        if(!$value) {
            if($this->authUserRating) {
                $this->is_contact_accurate = $this->authUserRating->is_contact_accurate;
                $this->is_location_accurate = $this->authUserRating->is_location_accurate;
                $this->communication_and_professionalism = $this->authUserRating->communication_and_professionalism;
                $this->quality_or_service = $this->authUserRating->quality_or_service;
                $this->recommendation = $this->authUserRating->recommendation;
            } else {
                $this->reset([
                    'is_contact_accurate',
                    'is_location_accurate',
                    'communication_and_professionalism',
                    'quality_or_service',
                    'recommendation',
                    'showReviewForm',
                ]);
            }
            $this->resetErrorBag();
        }
    }

    public function submitReview()
    {
        $data = [
            'is_contact_accurate' => $this->is_contact_accurate,
            'is_location_accurate' => $this->is_location_accurate,
            'communication_and_professionalism' => $this->communication_and_professionalism,
            'quality_or_service' => $this->quality_or_service,
            'recommendation' => $this->recommendation,
        ];

        Validator::make($data, [
            'is_contact_accurate' => 'required|in:yes,no',
            'is_location_accurate' => 'required|in:yes,no',
            'communication_and_professionalism' => 'required|integer|min:1|max:5',
            'quality_or_service' => 'required|integer|min:1|max:5',
            'recommendation' => 'required|integer|min:1|max:5',
        ])->validate();

        $review = ProductSellerReview::updateOrCreate(
            [
                'customer_id' => Auth::id(),
                'seller_id' => $this->user->id
            ],
            [
                'is_contact_accurate' => $this->is_contact_accurate,
                'is_location_accurate' => $this->is_location_accurate,
                'communication_and_professionalism' => $this->communication_and_professionalism,
                'quality_or_service' => $this->quality_or_service,
                'is_expert' => Auth::user()->is_reviewer,
                'recommendation' => $this->recommendation,
            ]
        );

        $this->reset([
            'showReviewForm',
        ]);

        $message = $review->wasRecentlyCreated ? 'Review Added Successfully' : 'Review Updated Successfully';
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    #[Computed]
    public function wishlistIds()
    {
        $type = $this->user->offering === 'product' ? Product::class : Service::class;
        
        return Auth::user()
            ->wishlist()
            ->where('wishable_type', $type)
            ->pluck('wishable_id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.user.view-business-profile')->extends('layouts.profile-layout');
    }
}