<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Welcome extends Component
{

    public $section;
    public $data = [];
    public $search = '';
    public $isOpen = false;
    public $cities = [];
    public $selectedCity = '';

    #[Computed()]
    public function updatedSearch()
    {
        $this->isOpen = true;
        $this->cities = City::where('title', 'like', '%' . $this->search . '%')
            ->limit(50)
            ->pluck('title')
            ->toArray();
    }

    public function selectCity($city)
    {
        $this->selectedCity = $city;
        $this->search = $city;
        $this->isOpen = false;
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && $this->search === '') {
            $this->updatedSearch();
        }
    }

    public function mount(){
        $this->section = 'product';
        $this->data = Category::where('type',$this->section)->get();
    }

    public function dashboardRedirect()
    {
        $user = Auth::user();
        if ($user->onboard_completed) {
            if ($user->type == 'individual') {
                return route('user.profile');
            } else if ($user->type == 'business') {
                return route('business.profile');
            } else if ($user->type == 'service') {
                return route('service.profile');
            }
        } else {
            return route('onboarding');
        }
    }

    public function setSection($test){
        $this->section = $test;
        $this->data = Category::where('type',$this->section)->get();
    }

    public function render()
    {
        return view('livewire.home.welcome')->extends('layouts.home');;
    }
}
