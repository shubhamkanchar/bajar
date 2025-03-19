<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class ProductReview extends Component
{
    public $product = null;
    public $is_approved;
    public $orderBy = 'recent';
    public $start_date;
    public $end_date;

    #[Computed()]
    public function products()
    {
        $query = Product::with(['images', 'user']);

        if ($this->orderBy === 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($this->orderBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($this->orderBy === 'seller') {
            $query->orderBy('user_id', 'asc');
        } elseif ($this->orderBy === 'date-range') {
            if (!empty($this->start_date) && !empty($this->end_date)) {
                $query->whereBetween('created_at', [
                    Carbon::parse($this->start_date)->startOfDay(),
                    Carbon::parse($this->end_date)->endOfDay()
                ]);
            } elseif (!empty($this->start_date)) {
                $query->whereDate('created_at', '>=', Carbon::parse($this->start_date)->startOfDay());
            } elseif (!empty($this->end_date)) {
                $query->whereDate('created_at', '<=', Carbon::parse($this->end_date)->endOfDay());
            }
        }

        if ($this->is_approved == 1) {
            $filteredProducts = $query->where('is_approved', $this->is_approved)->get();
        } else {
            $filteredProducts = $query->where(function ($q) {
                $q->where('is_approved', null)
                    ->orWhere('is_approved', 0);
            })->get();
        }

        if ($this->orderBy === 'seller') {
            $filteredProducts = $filteredProducts->groupBy('user.name');
        } else {
            $filteredProducts = $filteredProducts->groupBy(function ($product) {
                return Carbon::parse($product->created_at)->format('d M Y');
            });
        }

        return $filteredProducts;
    }

    #[Computed()]
    public function count()
    {
        return $this->products->count();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'product')->get();
    }

    #[Renderless]
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product->load('images');
    }

    public function approveProduct()
    {
        $this->product->is_approved = true;
        $this->product->save();
        $this->dispatch('productStatusChanged', [
            'type' => 'success',
            'message' => 'Product Approve '
        ]);
    }

    public function rejectProduct()
    {
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
