<?php

namespace App\Livewire\Business;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

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


    public function messages()
    {
        return [
            'product_images.*.image' => 'Please add image.',
            'product_images.*.image' => 'The image must be a valid image file.',
            'product_images.*.max' => 'The image cannot be larger than 1MB.',
        ];
    }

    public function saveProduct()
    {
        // Validate the data
        $this->validate();

        // Create the product instance
        $product = new Product();
        $product->name = $this->product_name;
        $product->brand_name = $this->brand_name;
        $product->description = $this->description;  // Assuming this field exists in your form
        $product->category_id = $this->category;
        $product->show_price = $this->showPrice;
        $product->product_tag_group_id = $this->product_tag_group_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->user_id = 1;
        $product->business_id = 1;
        $product->save(); // Save product to database

        // Store images
        foreach ($this->product_images as $key => $image) {
            if ($image) {
                // Save the image in the 'public/products' folder
                $path = $image->store('products', 'public');

                // Create a ProductImage record (if needed)
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path
                ]);
            }
        }

        // Success message
        session()->flash('message', 'Product added successfully!');
    }
    // Method to remove an image
    public function removeImage($image)
    {
        $this->product_images[$image] = null;
    }

    public function render()
    {
        return view(
            'livewire.business.profile',
            [
                'categories' => Category::all()
            ]
        )->extends('layouts.profile-layout');
    }
}
