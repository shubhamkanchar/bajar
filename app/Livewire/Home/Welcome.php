<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
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
    public $productName;
    public $sellers = [];
    public $searchStarted = false;

    public function mount(){
        $this->section = 'product';
        $this->data = Category::where('type',$this->section)->get();
    }

    public function updatedSearch()
    {
        $this->isOpen = true;
        $this->cities = City::where('title', 'like', '%' . $this->search . '%')
            ->limit(50)
            ->pluck('title')
            ->toArray();
    }

    public function searchProduct(){
        $this->searchStarted = true;    
        $this->sellers = User::with(['address','category'])
            // ->where('city',$this->search)
            // ->where('offering',$this->section)
            ->get();
    

        // $this->sellers = [
        //     [
        //         'name' => 'Elemento Enterprise',
        //         'image' => asset('images/elemento.jpg'),
        //         'rating' => 400,
        //         'visitors' => 20,
        //         'timing' => '9:00AM - 5:00PM',
        //         'gst' => '27ADSF54809E1ZP',
        //         'categories' => ['Tiles & Granites', 'Ply & Laminates', 'Bricks | Paints'],
        //         'address' => '1st Floor, Sagar Heights, Nagar-Pune Road, Opposite McDonalds, Kedgaon-414005',
        //     ]
        // ];
    }

    public function clearSearch(){
        $this->searchStarted = false;
        $this->productName = '';
        $this->sellers = [];
    }


    public function selectCity($city)
    {
        $this->selectedCity = $city;
        $this->search = '';
        $this->isOpen = false;
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && $this->search === '') {
            $this->updatedSearch();
        }
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
