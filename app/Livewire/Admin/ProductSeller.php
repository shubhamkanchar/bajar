<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductSeller extends Component
{
    public $state;
    public $city;
    public $categoryIds = [];
    public $stateOptions = [];
    public $cityOptions = [];
    public $sellers = [];
    public $orderBy;

    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    public function setState()
    {
        foreach (config('state') as $key => $state) {
            array_push($this->stateOptions, $key);
        }
    }

    public function setCity()
    {
        if ($this->state) {
            $this->cityOptions = config('state')[$this->state];
        } else {
            $this->cityOptions = [];
        }
    }

    #[Computed()]
    public function productSellers(){
        $filteredSellers = User::where('offering','product')->get();
        if ($this->orderBy === 'state') {
            $filteredSellers = $filteredSellers->groupBy(function ($product) {
                return $product->address->state;
            });
        } else if($this->orderBy === 'city') {
            $filteredSellers = $filteredSellers->groupBy(function ($product) {
                return $product->address->city;
            });
        }else{
            $filteredSellers = $filteredSellers->groupBy(function ($product) {
                return Carbon::parse($product->created_at)->format('d M Y');
            });
        }
        return $filteredSellers;
    }

    public function render()
    {
        return view('livewire.admin.product-seller')->extends('layouts.admin');
    }
}
