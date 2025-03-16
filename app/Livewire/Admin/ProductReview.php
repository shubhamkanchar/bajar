<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductReview extends Component
{
    public $product = null;

    #[Computed()]
    public function products() {
        return Product::with('images')->get();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'product')->get();
    }
    
    public function setProduct(Product $product) {
        $this->product = $product->load('images');
    }   
    
    public function approveProduct() {
        $this->product->is_approved = true;
        $this->product->save();
        $this->dispatch('productStatusChanged', [
            'type' => 'success',
            'message' => 'Product Approve '
        ]);
    }

    public function rejectProduct() {
        $this->product->is_approved = false;
        $this->product->save();
        $this->dispatch('productStatusChanged', [
            'type' => 'success',
            'message' => 'Product rejected '
        ]);
    }

    public function render()
    {
        return view('livewire.admin.product-review')->extends('layouts.admin');
    }
}
