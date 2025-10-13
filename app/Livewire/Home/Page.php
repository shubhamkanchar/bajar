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
        } else if($slug == 'privacy-policy') {
            $this->post = ModelsPage::where('page','pp')->first();
        }else if($slug == 'refund-policy'){
            $this->post = ModelsPage::where('page','rp')->first();
        }
    }

    public function render()
    {
        return view('livewire.home.page');
    }
}
