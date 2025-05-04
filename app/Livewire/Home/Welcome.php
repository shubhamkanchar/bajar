<?php

namespace App\Livewire\Home;

use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Welcome extends Component
{

    public $section, $ads;
    public $data = [];
    public $search = '';
    public $isOpen = false;
    // public $cities = [];
    public $selectedCity = '';
    public $productName;
    public $blogs = [];
    public $searchStarted = false;


    public function mount()
    {
        $this->blogs = Blog::orderBy('updated_at', 'DESC')->limit(6)->get();
        $this->ads = Advertisement::all();
        $this->section = 'product';
        $this->data = Category::where('type', $this->section)->get();
        $user = Auth::user();
        if($user) {
            $this->selectedCity = $user->address?->city ?? '';
        }
        $this->updatedSearch();
        $this->isOpen = false;

    }

    public function viewBlog($slug)
    {
        return redirect()->route('blog', ['slug' => $slug]);
    }

    public function updatedSearch()
    {
        $this->isOpen = true;
    }

    #[Computed]
    public function cities() {
        return City::where('title', 'like', '%' . $this->search . '%')
        ->limit(50)
        ->pluck('title')
        ->toArray();
    }

    #[Computed]
    public function sellers() {
        return User::with(['address', 'category'])
                ->whereHas('address', function ($query) {
                    $query->where('addresses.city', $this->selectedCity);
                })
                ->whereNotIn('role', ['superadmin', 'admin'])
                ->where('offering', $this->section)
                ->get();
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
            if ($user->role == 'individual') {
                return route('user.profile');
            } else if ($user->role == 'business') {
                return route('business.profile');
            } else if ($user->role == 'service') {
                return route('service.profile');
            }
        } else {
            return route('onboarding');
        }
    }

    public function setSection($test)
    {
        $this->section = $test;
        $this->data = Category::where('type', $this->section)->get();
    }

    public function render()
    {

        return view('livewire.home.welcome')->extends('layouts.home');
    }
}
