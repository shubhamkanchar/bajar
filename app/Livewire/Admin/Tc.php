<?php

namespace App\Livewire\Admin;

use App\Models\Page;
use Livewire\Component;

class Tc extends Component
{
    public $sliderStatus, $title, $description,$page,$state,$ppDate,$tcDate;

    public function mount(){
        $this->tcDate = Page::where('page','tc')->value('updated_at');
        $this->ppDate = Page::where('page','pp')->value('updated_at');
    }

    public function openSlider($state)
    {
        $this->reset(['description']);
        $this->title = $state == 'tc' ? 'Terms and conditions' : 'Privacy Policy' ;
        $this->page = Page::where('page',$state)->first();
        $this->state = $state;
        if($this->page){
            $this->description = $this->page->description;
        }
        $this->sliderStatus = 'open';
        
    }

    public function update(){
        $page = Page::firstOrNew(['page' => $this->state]);
        if($page){
            $page->description = $this->description;
        }
        
        if($page->save()){
            $this->sliderStatus = '';
            $this->dispatch('productStatusChanged', [
                'type' => 'success',
                'message' => $this->title.' page updated successfully'
            ]);
        }else{
            $this->dispatch('productStatusChanged', [
                'type' => 'error',
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function closeSlider()
    {
        $this->sliderStatus = '';
    }

    public function render()
    {
        return view('livewire.admin.tc')->extends('layouts.admin');
    }
}
