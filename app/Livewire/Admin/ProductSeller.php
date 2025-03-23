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

    public function mount(){
        $this->setCity();
        $this->setState();
    }

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

    public function deleteProductSeller($uuid)
    {
        $data = User::where('uuid',$uuid)->first();
        if($data){
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'User deleted successfully',
            ]);
        }else{
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        } 
    }

    public function setCity()
    {
        if ($this->state && $this->state != 'Select State') {
            $this->cityOptions = config('state')[$this->state];
        } else {
            $this->cityOptions = config('state')['Maharashtra'];
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
                return $product->address->city;
            });
        }
        return $filteredSellers;
    }

    public function render()
    {
        return view('livewire.admin.product-seller')->extends('layouts.admin');
    }
}
