<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProductSeller extends Component
{
    public $state;
    public $city;
    public $categoryIds = [];
    public $stateOptions = [];
    public $cityOptions = [];
    
    public function render()
    {
        return view('livewire.admin.product-seller')->extends('layouts.admin');
    }
}
