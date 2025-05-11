<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ServiceReview extends Component
{
    public $selectedProduct;
    public $is_approved;
    public $orderBy = 'recent';
    public $start_date;
    public $end_date;
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPage = 1;

    #[Computed()]
    public function products()
    {
        $query = Service::with(['images', 'user']);

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

        $query->whereNull('is_approved')->orWhere('is_approved',0);

        $totalRecord = $query->count();
        $this->totalPage = ceil($totalRecord / $this->perPage);
        
        $startLimit = ($this->currentPage - 1) * $this->perPage;

        $query->skip($startLimit)->take($this->perPage);

        $filteredProducts = $query->get();
 
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
    public function pendingApproval()
    {
        return Service::whereNull('is_approved')->orWhere('is_approved',0)->count();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'service')->get();
    }

    public function setProduct($id)
    {
        $this->selectedProduct = Service::find($id)->load('images');
        
    }

    public function updatedOrderBy($value) {
        if($value != 'date-range') {
            $this->reset(['currentPage','perPage','totalPage', 'start_date', 'end_date']);
        }
    }

    public function updatedStartDate($value) {
        $this->orderBy = 'date-range';
        $this->reset(['currentPage','perPage','totalPage']);
    }

    public function updatedEndDate($value) {
        $this->orderBy = 'date-range';
        $this->reset(['currentPage','perPage','totalPage']);
    }

    public function rejectProduct($id)
    {
        Service::where('id', $id)->update(['is_approved' => 0]);
        $this->dispatch('productStatusChanged', [
            'type' => 'success',
            'message' => 'Product rejected '
        ]);
    }

    public function approveProduct($id)
    {
        Service::where('id', $id)->update(['is_approved' => 1]);
        $this->dispatch('productStatusChanged', [
            'type' => 'success',
            'message' => 'Product Approved '
        ]);
    }

    public function render()
    {
        return view('livewire.admin.service-review');
    }
}
