<?php

namespace App\Livewire\Business;

use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
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
    #[Validate(rule: 'required', message: 'Price is required')]
    public $price;
    #[Validate(rule: 'required', message: 'Description is required')]
    public $description;
    #[Validate(rule: 'required', message: 'Brand name is required')]
    public $brand_name;
    #[Validate(rule: 'required', message: 'Product name is required')]
    public $product_name;
    #[Validate(rule: 'required', message: 'Quantity is required')]
    public $quantity;
    #[Validate(rule: 'required', message: 'Please select category')]
    public $category;
    #[Validate(rule: 'required', message: 'Please select product tag/group')]
    public $product_tag_group_id;

    public function mount(){
        $this->user = Auth::user();
    }

    public function messages()
    {
        return [
            'product_images.*.image' => 'Please add image.',
            'product_images.*.image' => 'The image must be a valid image file.',
            'product_images.*.max' => 'The image cannot be larger than 1MB.',
        ];
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
            return Product::with(['images', 'category'])->where('user_id', auth()->id())->get()->groupBy('category.title');
        }
        return Product::with(['images', 'category'])->where(['user_id' => auth()->id(), 'category_id' => $this->selectedCategory])->get()->groupBy('category.title');
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'product')->get();
    }

    #[Computed]
    public function businessCategories() {
        $ids = Product::where('user_id', auth()->id())->pluck('category_id');
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

    public function saveProduct()
    {
        $rules = [
            'product_name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'showPrice' => 'required',
            'product_tag_group_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ];
    
        // If creating a new product, ensure images are uploaded
        if (!$this->isEdit) {
            $rules['product_images.*'] = 'required|image|max:1024';
        } else {
            // If editing, allow either a file upload or an existing image string
            $rules['product_images.*'] = 'required|max:2048';
        }
        $this->validate($rules);

        $product = $this->isEdit ? Product::findOrFail($this->editProductId) : new Product();

        $product->name = $this->product_name;
        $product->brand_name = $this->brand_name;
        $product->description = $this->description;
        $product->category_id = $this->category;
        $product->show_price = $this->showPrice;
        $product->product_tag_group_id = $this->product_tag_group_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->user_id = auth()->id();
        $product->business_id = 1;
        $product->save();

        if ($this->isEdit) {
            $existingImages = $product->images()->orderBy('order')->get();

            foreach ($existingImages as $index => $existingImage) {
                $key = 'product_image' . ($index + 1);
                if (!empty($this->product_images[$key])) {
                    $image = $this->product_images[$key];

                    // Get new image path if uploaded, otherwise keep old path
                    $path = is_string($image) ? $image : $image->store('products', 'public');
                    // Update only the path for existing images
                    $existingImage->update(['path' => $path]);
                }
            }
        } else {
            // Ensure exactly 6 images are created in order for new product
            foreach (range(1, 6) as $index) {
                $key = 'product_image' . $index;

                if (!empty($this->product_images[$key])) {
                    $image = $this->product_images[$key];

                    // Store the image
                    $path = $image->store('products', 'public');
                    // Create new image record with correct order
                    ProductImage::create([
                        'product_id' => $product->id,
                        'order' => $index,
                        'path' => $path
                    ]);
                }
            }
        }

        $this->dispatch('productUpdated', [
            'type' => 'success',
            'message' => $this->isEdit ? 'Producted updated successfully' : 'Product added successfully'
        ]);

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

    public function deleteProduct()
    {
        $product = $this->isEdit ? Product::findOrFail($this->editProductId) : new Product();
        $productImages = $product->images();
        foreach($productImages as $image) {
            $imagePath = public_path("storage/{$image->path}");

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $productImages->delete();

        $product->delete();
        $this->resetProduct();
        $this->dispatch('productDeleted', [
            'type' => 'success',
            'message' => 'Product deleted '
        ]);
    }

    // Method to remove an image
    public function removeImage($image)
    {
        $this->product_images[$image] = null;
        // dd($this->product_images);
    }

    public function render()
    {
        return view(
            'livewire.business.profile',
        )->extends('layouts.profile-layout');
    }
}
