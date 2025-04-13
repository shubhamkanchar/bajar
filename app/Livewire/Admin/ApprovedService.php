<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ApprovedService extends Component
{

    public $search = '';
    public $selectedCity;
    public $selectedState;
    public $selectedCategory;

    public $selectedProduct;
    public $is_approved;
    public $orderBy = 'seller';
    public $start_date;
    public $end_date;
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPage = 1;

    #[Computed()]
    public function products()
    {
        $query = Service::with(['images', 'user']);

        $query->orderBy('user_id', 'asc');

        if(!empty($this->search)) {
            $query->where(function($q) {
                $q->whereAny(
                    [
                        'name',
                        'brand_name',
                        'description',
                        'price'
                    ],
                    'LIKE',
                    "%$this->search%"
                );
            });
        }

        if (!empty($this->selectedState)) {
            $query->whereHas('user.address', function ($q) {
                $q->where('state', $this->selectedState);
            });
        }
        
        if (!empty($this->selectedCity)) {
            $query->whereHas('user.address', function ($q) {
                $q->where('city', $this->selectedCity);
            });
        }
        
        if (!empty($this->selectedCategory)) {
            $query->whereHas('category', function ($q) {
                $q->where('title', $this->selectedCategory);
            });
        }

        $query->where('is_approved', 1);

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
    public function totalProducts()
    {
        return Service::where('is_approved', 1)->count();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('type', 'product')->get();
    }

    #[Computed]
    public function states() {
        $allStates = [];
        foreach(config('state') as $key => $state){
            $allStates[] = $key;
        }
        return $allStates;
    }

    #[Computed]
    public function cities(){
        if($this->selectedState){
           return config('state')[$this->selectedState];
        } 
        return [];
    }

    public function setProduct($id)
    {
        $this->selectedProduct = Service::find($id)->load('images');
        
    }

    public function updatedOrderBy($value) {
        $this->reset(['currentPage','perPage','totalPage', 'start_date', 'end_date']);
    }


    public function updatedSelectedState($value) {
        if(empty($value)) {
            $this->reset('selectedCity');
        }
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
        return view('livewire.admin.approved-service');
    }
}
