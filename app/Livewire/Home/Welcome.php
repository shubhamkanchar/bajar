<?php

namespace App\Livewire\Home;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{

    public $section;
    public $data = [];

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
