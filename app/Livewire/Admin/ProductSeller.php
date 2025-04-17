<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductSeller extends Component
{
    public $search = '';
    public $selectedCity;
    public $selectedState;
    public $selectedCategory;

    public $state;
    public $expert = 0;
    public $city;
    public $categoryIds = [];
    public $stateOptions = [];
    public $cityOptions = [];
    public $sellers = [];
    public $orderBy;
    public string $type;

    public function mount(string $type){
        $this->setCity();
        $this->setState();
        $this->type = $type;
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

    public function setExpert(){
        $this->expert = !$this->expert;
    }

    #[Computed()]
    public function productSellers(){
        if($this->type == 'individual'){
            $query = User::where('type','individual')->with(['address'])->whereNotIn('role', ['superadmin', 'admin']);
        }else{
            $query = User::where('offering',$this->type)->with(['address']);
        }

        if(!empty($this->search)) {
            $query->where(function($q) {
                $q->whereAny(
                    [
                        'name',
                        'phone',
                        'email',
                    ],
                    'LIKE',
                    "%$this->search%"
                );
            });
        }

        if($this->expert){
            $query->where('is_reviewer', 1);
        }
        
        if (!empty($this->selectedState)) {
            $query->whereHas('address', function ($q) {
                $q->where('state', $this->selectedState);
            });
        }
        
        if (!empty($this->selectedCity)) {
            $query->whereHas('address', function ($q) {
                $q->where('city', $this->selectedCity);
            });
        }
        
        if (!empty($this->selectedCategory)) {
            $query->whereHas('category', function ($q) {
                $q->where('category_id', $this->selectedCategory['id']);
            });
        }

        $filteredSellers = $query->get();

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
