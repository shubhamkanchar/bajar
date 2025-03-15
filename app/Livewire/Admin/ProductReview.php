<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProductReview extends Component
{
    public function render()
    {
        return view('livewire.admin.product-review')->extends('layouts.admin');
    }
}
