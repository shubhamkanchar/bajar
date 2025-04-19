<?php

namespace App\Livewire\Home;

use App\Models\Page as ModelsPage;
use Livewire\Component;

class Page extends Component
{
    public $post; 

    public function mount($slug = null)
    {
        if ($slug == 'terms-and-conditions') {
            $this->post = ModelsPage::where('page','tc')->first();
        } else {
            $this->post = ModelsPage::where('page','tc')->first();
        }
    }

    public function render()
    {
        return view('livewire.home.page')->extends('layouts.home');
    }
}
